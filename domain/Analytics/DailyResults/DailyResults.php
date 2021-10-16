<?php

namespace Domain\Analytics\DailyResults;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class DailyResults
{
    /**
     * @var Collection
     */
    private $results;

    public function __construct(Collection $data)
    {
        $this->results = $data;
    }

    public function get() : Collection
    {
        return $this->results;
    }

    public function total() : Collection
    {
        if ($this->results->count() == 0)
            return collect();

        $carry = $this->results->first();
        return $this->results->map(function ($value, $key) use (&$carry)
        {
            if ($this->results->keys()[0] == $key)
                return $carry;
            return $carry += $value;
        });
    }
}
