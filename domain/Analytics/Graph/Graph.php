<?php

namespace Domain\Analytics\Graph;

use Domain\Analytics\Graph\DataSets\DataSet;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class Graph implements Arrayable
{
    private $dataSets = [];
    /**
     * @var array
     */
    private $labels;

    public function __construct(Collection $labels, DataSet ...$dataSets)
    {
        $this->labels   = $labels;
        $this->dataSets = collect($dataSets);
    }

    public function addDataSet(DataSet $dataSet)
    {
        $this->dataSets->add($dataSet);
    }

    public function setLabels(Collection $labels)
    {
        $this->labels = $labels;
    }

    public function datasets() : Collection
    {
        return $this->dataSets->map(function (DataSet $dataSet)
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
