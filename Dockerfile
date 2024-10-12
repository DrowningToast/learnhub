FROM ubuntu:22.04

LABEL maintainer="Taylor Otwell"

ARG WWWGROUP
ARG NODE_VERSION=20
ARG POSTGRES_VERSION=15

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=UTC
ENV SUPERVISOR_PHP_COMMAND="/usr/bin/php -d variables_order=EGPCS /var/www/html/artisan serve --host=0.0.0.0 --port=80"

# Set timezone and install required packages
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
    && apt-get update \
    && mkdir -p /etc/apt/keyrings \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2 dnsutils librsvg2-bin fswatch ffmpeg \
    # Add PHP 8.3 repository and install PHP packages
    && curl -sS 'https://keyserver.ubuntu.com/pks/lookup?op=get&search=0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c' | gpg --dearmor | tee /etc/apt/keyrings/ppa_ondrej_php.gpg > /dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && apt-get update \
    && apt-get install -y php8.3-cli php8.3-dev \
       php8.3-pgsql php8.3-sqlite3 php8.3-gd php8.3-curl php8.3-imap php8.3-mysql php8.3-mbstring \
       php8.3-xml php8.3-zip php8.3-bcmath php8.3-soap php8.3-intl php8.3-readline php8.3-ldap \
       php8.3-msgpack php8.3-igbinary php8.3-redis php8.3-swoole php8.3-memcached php8.3-pcov php8.3-imagick php8.3-xdebug \
    # Install Node.js and Yarn
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_VERSION.x nodistro main" > /etc/apt/sources.list.d/nodesource.list \
    && apt-get update \
    && apt-get install -y nodejs \
    && npm install -g npm pnpm bun \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | gpg --dearmor | tee /etc/apt/keyrings/yarn.gpg >/dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/yarn.gpg] https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && curl -sS https://www.postgresql.org/media/keys/ACCC4CF8.asc | gpg --dearmor | tee /etc/apt/keyrings/pgdg.gpg >/dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/pgdg.gpg] http://apt.postgresql.org/pub/repos/apt jammy-pgdg main" > /etc/apt/sources.list.d/pgdg.list \
    && apt-get update \
    && apt-get install -y yarn mysql-client postgresql-client-$POSTGRES_VERSION \
    # Clean up
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Allow PHP to bind to port 80
RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.3

# Create a non-root user for running the application
RUN groupadd --force -g 1000 sail \
    && useradd -ms /bin/bash --no-user-group -g 1000 -u 1337 sail \
    && chown -R sail:sail /var/www/

# Copy application and configuration files
COPY ./deploy/start-container /usr/local/bin/start-container
COPY ./deploy/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./deploy/php.ini /etc/php/8.3/cli/conf.d/99-sail.ini
COPY . /var/www/html
COPY ./.env.prod /var/www/html/.env
RUN chmod +x /usr/local/bin/start-container

# Install Composer dependencies (without development dependencies)
RUN composer install --no-dev --optimize-autoloader \
    && composer dump-autoload --optimize \
    && rm -rf /root/.composer/cache

# Install Node.js dependencies and build assets
RUN pnpm install \
    && rm -f /var/www/html/public/hot \
    && pnpm build

# Set proper permissions for storage and cache
RUN chmod -R 777 storage bootstrap/cache public

# Expose port 80 for the application
EXPOSE 80

ENTRYPOINT ["start-container"]
