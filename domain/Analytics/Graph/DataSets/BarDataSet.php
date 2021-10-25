<?php

namespace Domain\Analytics\Graph\DataSets;

use Illuminate\Support\Collection;

class BarDataSet extends DataSet
{
    private ?int $activeIndex = null;

    public function __construct($label, Collection $data, $color, ?int $activeIndex = null)
    {
        parent::__construct($label, $data, $color, false);
        $this->activeIndex = $activeIndex;
    }

    public function toArray()
    {
        return [
            'borderColor'     => $this->borderColor,
            'backgroundColor' => $this->data->map(function($value, $index) {
                if ($index === $this->activeIndex)
                    return "#94C843";
                return $this->backgroundColor;
            }),
            'label'           => $this->label,
            'data'            => $this->data
        ];
    }
}
