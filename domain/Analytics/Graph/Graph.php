<?php

namespace Domain\Analytics\Graph;

use Domain\Analytics\Graph\DataSets\DataSet;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * @implements Arrayable<string, string|Collection>
 */
class Graph implements Arrayable
{
    /** @var Collection<int|string, DataSet>  */
    private Collection $dataSets;
    /** @var Collection<int, string> */
    private Collection $labels;

    /**
     * @param Collection<int, string> $labels
     * @param DataSet ...$dataSets
     */
    public function __construct(Collection $labels, DataSet ...$dataSets)
    {
        $this->labels = $labels;
        $this->dataSets = collect($dataSets);
    }

    public function addDataSet(DataSet $dataSet) : void
    {
        $this->dataSets->add($dataSet);
    }

    /**
     * @param Collection<int, string> $labels
     * @return void
     */
    public function setLabels(Collection $labels) : void
    {
        $this->labels = $labels;
    }

    /**
     * @return Collection<int|string, array>
     */
    public function datasets() : Collection
    {
        return $this->dataSets->map(function (DataSet $dataSet) {
            return $dataSet->toArray();
        });
    }

    /**
     * @return Collection<int, string>
     */
    public function labels() : Collection
    {
        return $this->labels;
    }

    public function toArray()
    {
        return [
            'labels'   => $this->labels,
            'datasets' => $this->datasets(),
        ];
    }
}
