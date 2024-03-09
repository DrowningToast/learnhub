<div>
    @if ($isSelected)
        <a href="{{ $url }}" class="flex flex-row items-center gap-4 text-lg "
            style="text-decoration: none !important; color: black;">
            <img src="{{ asset($iconSrc) }}" alt="menu" class="w-8">
            <p class="text-white font-semibold">{{ $title }}</p>
        </a>
    @else
        <a href="{{ $url }}"
            class="flex flex-row items-center gap-4 text-lg text-white opacity-50 hover:opacity-100"
            style="text-decoration: none !important; color: black;">
            <img src="{{ asset($iconSrc) }}" alt="menu" class="w-8">
            <p class="text-white font-semibold">{{ $title }}</p>
        </a>
    @endif
</div>
