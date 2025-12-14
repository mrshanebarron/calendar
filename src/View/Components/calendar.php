<?php

namespace MrShaneBarron\calendar\View\Components;

use Illuminate\View\Component;

class calendar extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('ld-calendar::components.calendar');
    }
}
