<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

enum TransactionType
{
    case RECEIVE;
    case WITHDRAW;
}
;

enum TransactionStatus
{
    case PENDING;
    case COMPLETED;
    case CANCELLED;
}
;


class transactionHistoryCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $amount,
        public string $type,
        public string $status,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transaction-history-card');
    }
}
