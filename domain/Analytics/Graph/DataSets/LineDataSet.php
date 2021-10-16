<?php

namespace Domain\Analytics\Graph\DataSets;

use Illuminate\Support\Collection;

class LineDataSet extends DataSet
{
    public function __construct($label, Collection $data, $color, $transparent = false)
    {
        parent::__construct($label, $data, $color, true);
    }
}
