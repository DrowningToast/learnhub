FROM ubuntu:22.04

LABEL maintainer="Taylor Otwell"

ARG WWWGROUP
ARG NODE_VERSION=20
ARG POSTGRES_VERSION=15

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install system dependencies and PHP extensions
RUN apt-get update \
    && mkdir -p /etc/apt/keyrings \
    && apt-get install -y --no-install-recommends \
        gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2 dnsutils librsvg2-bin fswatch ffmpeg \
    && curl -sS 'https://keyserver.ubuntu.com/pks/lookup?op=get&search=0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c' | gpg --dearmor | tee /etc/apt/keyrings/ppa_ondrej_php.gpg > /dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        php8.3-cli php8.3-dev \
        php8.3-pgsql php8.3-sqlite3 php8.3-gd \
        php8.3-curl php8.3-imap php8.3-mysql php8.3-mbstring \
        php8.3-xml php8.3-zip php8.3-bcmath php8.3-soap \
        php8.3-intl php8.3-readline php8.3-ldap \
        php8.3-msgpack php8.3-igbinary php8.3-redis php8.3-swoole \
        php8.3-memcached php8.3-pcov php8.3-imagick php8.3-xdebug \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_VERSION.x nodistro main" > /etc/apt/sources.list.d/nodesource.list \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        nodejs \
    && npm install -g npm \
    && npm install -g pnpm bun \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | gpg --dearmor | tee /etc/apt/keyrings/yarn.gpg >/dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/yarn.gpg] https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && curl -sS https://www.postgresql.org/media/keys/ACCC4CF8.asc | gpg --dearmor | tee /etc/apt/keyrings/pgdg.gpg >/dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/pgdg.gpg] http://apt.postgresql.org/pub/repos/apt jammy-pgdg main" > /etc/apt/sources.list.d/pgdg.list \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        yarn mysql-client postgresql-client-$POSTGRES_VERSION \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.3

# Create user and group
RUN groupadd --force -g 1000 sail \
    && useradd -ms /bin/bash --no-user-group -g 1000 -u 1337 sail \
    && chown -R sail:sail /var/www/

# Copy configuration and application files
COPY ./deploy/start-container /usr/local/bin/start-container
COPY ./deploy/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./deploy/php.ini /etc/php/8.3/cli/conf.d/99-sail.ini
COPY . /var/www/html
COPY ./.env.prod /var/www/html/.env

# Make start-container script executable
RUN chmod +x /usr/local/bin/start-container

# Switch to non-root user
USER sail

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Clear and cache Laravel configurations
RUN php artisan config:cache
RUN php artisan route:clear
RUN php artisan view:clear

# Install Node.js dependencies and build Vite assets
RUN pnpm install --frozen-lockfile
RUN pnpm build

# Set permissions
RUN chmod -R 775 storage bootstrap/cache public

# Expose application port
EXPOSE 8000

# Start the application
ENTRYPOINT ["start-container"]
