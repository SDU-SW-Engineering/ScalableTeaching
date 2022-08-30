<?php

namespace Domain\Analytics\Graph\DataSets;

use App\Models\Project;
use Illuminate\Support\Collection;

class LineDataSet extends DataSet
{
    /**
     * @param string $label
     * @param Collection<int,int> $data
     * @param string $color
     * @param bool $transparent
     */
    public function __construct(string $label, Collection $data, string $color, bool $transparent = false)
    {
        parent::__construct($label, $data, $color, $transparent);
    }
}
