<?php

namespace Domain\Analytics\DailyResults;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use DB;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Str;

class DailyQuery
{
    /**
     * @var HasMany
     */
    private $query;
    /**
     * @var string
     */
    private $column;

    public function __construct(Builder $query, string $column = "created_at")
    {
        $this->query  = $query;
        $this->column = $column;
    }

    public function daily(Carbon $start, Carbon $end) : DailyResults
    {
        $occurrencesPerDay = $this->query
            ->select($this->selection())
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        return new DailyResults($this->fillGaps($occurrencesPerDay, $start, $end));
    }

    private function selection() : array
    {
        return [
            DB::raw('count(*) as count'),
            DB::raw("date(`{$this->query->from}`.`{$this->column}`) as date")
        ];
    }

    private function fillGaps(Collection $occurrencesPerDay, Carbon $start, Carbon $end) : Collection
    {
        $dates = CarbonPeriod::create($start->startOfDay(), $end->endOfDay())->toArray();
        foreach ($dates as $date)
        {
            $dateString = $date->format('Y-m-d');
            if ($occurrencesPerDay->has($dateString))
                continue;
            $occurrencesPerDay[$dateString] = 0;
        }


        return $occurrencesPerDay->sortKeys();
    }
}
