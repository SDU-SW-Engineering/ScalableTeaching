<?php

namespace Domain\Analytics;

use Carbon\Carbon;
use Domain\Analytics\DailyResults\DailyQuery;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\ServiceProvider;

class AnalyticsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        HasMany::macro("daily", function(Carbon $start, Carbon $end, $column = 'created_at')  {
            /** @var HasMany $this */
            return (new DailyQuery($this->getQuery(), $column))->daily($start, $end);
        });

        HasManyThrough::macro("daily", function (Carbon $start, Carbon $end, $column = 'created_at') {
            /** @var HasManyThrough $this */
            return (new DailyQuery($this->getQuery(), $column))->daily($start, $end);
        });
    }
}
