<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Confirm extends Component
{
    public ?string $acceptRoute = null;
    public ?string $declineRoute = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $acceptRoute)
    {
        $this->acceptRoute = $acceptRoute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        dd($this->acceptRoute);
        return view('components.confirm');
    }
}
