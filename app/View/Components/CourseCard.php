<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CourseCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string $description,
        public string $src,
        public string $href,
        public string $author = '',
        // 0.0 -> 1.0
        public float $progress = 0.0,
        public string $primaryColor,
        public string $color,
        public string $shadowColor,
    ) {
        //   
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.course-card');
    }
}
