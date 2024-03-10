<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class doQuiz extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $number,
        public string $question,
        public string $answerA,
        public string $answerB,
        public string $answerC
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.do-quiz');
    }
}
