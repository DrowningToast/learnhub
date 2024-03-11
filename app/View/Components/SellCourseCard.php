<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class SellCourseCard extends Component
{
    public function __construct(
        public string $courseId,
        public string $banner,
        public string $lecturer,
        public string $lecProfile,
        public int $category,
        public string $description,
        public string $duration,
        public int $lectures,
        public string $price,
        public float $rating = 0.0
    ) {
        $this->price = number_format((float) $price, 2, '.', '');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sell-course-card');
    }
}
