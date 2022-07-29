<?php

namespace App\View\Components;

use App\Models\Task;
use Illuminate\View\Component;

class SidebarItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $name, public string $route)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar-item');
    }
}
