<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class QuizPopup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $courseid,
        public string $chapterid,
        public string $question,
        public string $choiceA,
        public string $choiceB,
        public string $choiceC,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.quiz-popup');
    }
}
