<?php

namespace Domain\Analytics\DailyResults;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 */
class DailyQuery
{
    /**
     * @var Builder<TModel>
     */
    private Builder $query;

    /**
     * @var string
     */
    private string $column;

    /**
     * @param  Builder<TModel>  $query
     * @param  string  $column
     */
    public function __construct(Builder $query, string $column = 'created_at')
    {
        $this->query = $query;
        $this->column = $column;
    }

    public function daily(Carbon $start, Carbon $end): DailyResults
    {
        $start = $start->startOfDay();
        $end = $end->endOfDay();
        /** @phpstan-ignore-next-line  */
        $occurrencesPerDay = $this->query
            ->select($this->selection())
            ->whereBetween("{$this->query->getQuery()->from}.$this->column", [$start, $end])
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        return new DailyResults($this->fillGaps($occurrencesPerDay, $start, $end));
    }

    private function selection(): array
    {
        return [
            DB::raw('count(*) as count'),
            DB::raw("date(`{$this->query->getQuery()->from}`.`{$this->column}`) as date"),
        ];
    }

    /**
     * @param  Collection<string, int>  $occurrencesPerDay
     * @param  Carbon  $start
     * @param  Carbon  $end
     * @return Collection<string, int>
     */
    private function fillGaps(Collection $occurrencesPerDay, Carbon $start, Carbon $end): Collection
    {
        $dates = CarbonPeriod::create($start, $end)->toArray();
        foreach ($dates as $date) {
            $dateString = $date->format('Y-m-d');
            if ($occurrencesPerDay->has($dateString)) {
                continue;
            }
            $occurrencesPerDay[$dateString] = 0;
        }

        return $occurrencesPerDay->sortKeys();
    }
}
