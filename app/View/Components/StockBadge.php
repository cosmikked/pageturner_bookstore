<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StockBadge extends Component
{
    public $status;
    public $color;
    public $text;
    /**
     * Create a new component instance.
     */
    public function __construct(bool $status)
    {
        $this->status = $status;
        $this->color = $this->determineColorAndText($status);
    }

    protected function determineColorAndText(bool $status): string
    {
        if ($status) {
            $this->text = "In Stock";
            return 'success';
        }
        $this->text = "Out of Stock";
        return 'danger';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stock-badge');
    }
}
