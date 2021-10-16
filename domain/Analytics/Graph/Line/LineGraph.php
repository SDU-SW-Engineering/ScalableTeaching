<?php

namespace Domain\Analytics\Graph\Line;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class LineGraph implements Arrayable
{
    private $dataSets = [];
    /**
     * @var array
     */
    private $labels;

    public function __construct(Collection $labels, LineDataSet ...$dataSets)
    {
        $this->labels   = $labels;
        $this->dataSets = collect($dataSets);
    }

    public function addDataSet(LineDataSet $dataSet)
    {
        $this->dataSets->add($dataSet);
    }

    public function setLabels(Collection $labels)
    {
        $this->labels = $labels;
    }

    public function datasets() : Collection
    {
        return $this->dataSets->map(function (LineDataSet $dataSet)
        {
            return $dataSet->toArray();
        });
    }

    public function labels() : Collection
    {
        return $this->labels;
    }

    public function toArray()
    {
        return [
            'labels' => $this->labels,
            'datasets' => $this->datasets()
        ];
    }
}
