<?php

namespace Domain\Analytics\Graph\Line;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class LineDataSet implements Arrayable
{
    private $borderColor;

    private $backgroundColor;

    private $label;

    private $data;

    public function __construct($label, Collection $data, $color)
    {
        $this->label = $label;
        $this->data  = $data->values();
        $this->borderColor = $color;
        $this->backgroundColor = $color . "44";
    }

    public function toArray()
    {
        return [
            'borderColor'     => $this->borderColor,
            'backgroundColor' => $this->backgroundColor,
            'label'           => $this->label,
            'data'            => $this->data
        ];
    }
}
