<?php

namespace Domain\Analytics\Graph\DataSets;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class DataSet implements Arrayable
{
    protected $borderColor;

    protected $backgroundColor;

    protected $label;

    protected $data;

    public function __construct($label, Collection $data, $color, $transparent = false)
    {
        $this->label = $label;
        $this->data  = $data->values();
        $this->borderColor = $color;
        $this->backgroundColor = $color . ($transparent ? "44" : "");
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
