<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Confirm extends Component
{
    public ?string $acceptRoute = null;

    public ?string $declineRoute = null;

    public string $header;

    public string $subHeader;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $acceptRoute, ?string $declineRoute, string $header, string $subHeader)
    {
        $this->acceptRoute = $acceptRoute;
        $this->declineRoute = $declineRoute;
        $this->header = $header;
        $this->subHeader = $subHeader;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.confirm');
    }
}
