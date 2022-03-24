<?php

namespace App\Nova\Metrics;

use App\Models\User;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;

class UsersPerMonth extends Trend
{
    /**
     * The width of the card on the dashboard.
     *
     * @var string
     */
    public $width = '1/4';

    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return TrendResult
     */
    public function calculate(NovaRequest $request): TrendResult
    {
        return $this->countByMonths($request, User::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            1 => __('1 month'),
            6 => __('6 months'),
            12 => __('12 months'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  DateTimeInterface
     */
    public function cacheFor(): DateTimeInterface
    {
        return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey(): string
    {
        return 'users-per-month';
    }
}
