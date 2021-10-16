<?php

namespace Domain\Analytics\Graph\DataSets;

use Illuminate\Support\Collection;

class BarDataSet extends DataSet
{
    public function __construct($label, Collection $data, $color)
    {
        parent::__construct($label, $data, $color, false);
    }
}
