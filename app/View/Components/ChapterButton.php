<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChapterButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $chapter,
        public string $title,
        public bool $done = false,
        public int $durationInMinutes = 0,
        public int $courseId,
        public int $chapterId
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chapter-button');
    }
}
