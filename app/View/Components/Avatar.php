<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Avatar extends Component
{
//    public $user;

    public function __construct()
    {
//        $this->user = $user;
    }

    public function render(): View
    {
        return view('components.avatar');
    }
}

