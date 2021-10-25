<?php

namespace Domain\Analytics;

use Carbon\Carbon;
use Domain\Analytics\DailyResults\DailyQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AnalyticsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        HasMany::macro("daily", function (Carbon $start, Carbon $end, $column = 'created_at')
        {
            /** @var HasMany $this */
            return (new DailyQuery($this->getQuery(), $column))->daily($start, $end);
        });

        HasManyThrough::macro("daily", function (Carbon $start, Carbon $end, $column = 'created_at')
        {
            /** @var HasManyThrough $this */
            return (new DailyQuery($this->getQuery(), $column))->daily($start, $end);
        });

        Builder::macro("daily", function (Carbon $start, Carbon $end, $column = 'created_at')
        {
            /** @var Builder $this */
            return (new DailyQuery($this, $column))->daily($start, $end);
        });

        Collection::macro('subtractByKey', function (Collection $subtractBy, $absolute = true)
        {
            /** @var Collection $this */
            return $this->map(function ($value, $index) use ($absolute, $subtractBy)
            {
                $endValue = $subtractBy == null ? 0 : ($subtractBy->has($index) ? $subtractBy[$index] - $value : $value);
                return $absolute ? abs($endValue) : $endValue;
            });
        });
    }
}
