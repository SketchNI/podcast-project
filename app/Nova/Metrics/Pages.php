<?php

namespace App\Nova\Metrics;

use App\Models\Page;
use DateInterval;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Metrics\ValueResult;

class Pages extends Value
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
     * @return ValueResult
     */
    public function calculate(NovaRequest $request): ValueResult
    {
        return $this->count($request, Page::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [];
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
        return 'pages';
    }
}
