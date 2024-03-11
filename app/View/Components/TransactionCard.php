<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class TransactionCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $pid,
        public string $name,
        public string $imgSrc,
        public float $money,
        public string $bankName,
        public string $accountNumber,
        public int $status,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transaction-card');
    }
}
