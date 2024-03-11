<div class="flex gap-x-1 items-center">
    <p>{{ number_format((float)$rating, 2) }}</p>
    <div class="flex gap-x-1 items-center mb-1">
        @php
            $i = 0;
        @endphp
        @while ($i < 5)
            @if ($rating > 0 && $rating < 1)
                @if ($rating > 0.5)
                    <img src="/img/stars/half.webp" alt="star" class="w-4 aspect-square">
                @else
                    <img src="/img/stars/empty.webp" alt="star" class="w-4 aspect-square">
                @endif
            @elseif ($rating >= 1)
                <img src="/img/stars/full.webp" alt="star" class="w-4 aspect-square">
            @elseif ($rating <= 0)
                <img src="/img/stars/empty.webp" alt="star" class="w-4 aspect-square">
            @endif
            @php
                $i++;
                $rating--;
            @endphp
        @endwhile
    </div>
</div>
