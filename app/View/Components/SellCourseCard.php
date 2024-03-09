<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SellCourseCard extends Component
{
    public string $durationString;

    public function __construct(
        public string $banner,
        public string $lecturer,
        public string $lecProfile,
        public string $category,
        public string $description,
        public int $duration,
        public int $lectures,
        public string $price,
        public float $rating = 3.8
    )
    {
        if ($duration >= 60) {
            $durationString = floor($duration/60) . ' ชั่วโมง ' . $duration % 60 . ' นาที';
            $duration = $duration % 60;
        } else {
            $durationString = floor($duration/60) . ' นาที';
        }
        $this->durationString = $durationString;
        $this->price = number_format((float)$price, 2, '.', '');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sell-course-card');
    }
}
