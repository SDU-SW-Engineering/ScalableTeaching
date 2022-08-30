<?php

namespace Domain\Analytics\DailyResults;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class DailyResults
{
    /**
     * @var Collection<string, int>
     */
    private Collection $results;

    /**
     * @param Collection<string,int> $data
     */
    public function __construct(Collection $data)
    {
        $this->results = $data;
    }

    /**
     * @return Collection<string,int>
     */
    public function get() : Collection
    {
        return $this->results;
    }

    /**
     * @return Collection<string, int>
     */
    public function total() : Collection
    {
        if ($this->results->count() == 0)
            return new Collection();

        $carry = $this->results->first();

        return $this->results->map(function ($value, $key) use (&$carry) {
            if ($this->results->keys()[0] == $key)
                return $carry;

            return $carry += $value;
        });
    }
}
