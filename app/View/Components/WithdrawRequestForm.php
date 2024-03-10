<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WithdrawRequestForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $bankName,
        public string $accountNumber,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.withdraw-request-form');
    }
}
