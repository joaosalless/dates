<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

use DateTime;
use Illuminate\Support\Collection;

/**
 * Class Week
 *
 * @package Joaosalless\Dates\Model
 */
class Week
{
    private const DAYS = [
        0 => 'sun',
        1 => 'mon',
        2 => 'tue',
        3 => 'wed',
        4 => 'thu',
        5 => 'fri',
        6 => 'sat',
    ];

    const DEFAULT_CONFIG = [
        'office_hours_start' => '09:00',
        'office_hours_end' => '18:00',
        'check_office_hours' => true,
        'check_office_hours_start' => true,
        'days' => [
            'sun' => [
                'business_day' => false,
            ],
            'mon' => [
                'business_day' => true,
            ],
            'tue' => [
                'business_day' => true,
            ],
            'wed' => [
                'business_day' => true,
            ],
            'thu' => [
                'business_day' => true,
            ],
            'fri' => [
                'business_day' => true,
            ],
            'sat' => [
                'business_day' => false,
            ],
        ]
    ];

    /**
     * @var Collection
     */
    private $days;

    /**
     * @var array|null
     */
    private $config;

    /**
     * Week constructor.
     *
     * @param array|null $config
     */
    public function __construct(?array $config = []) {

        $this->days = collect();

        $this->config = !empty($config)
            ? array_merge(self::DEFAULT_CONFIG, $config)
            : self::DEFAULT_CONFIG;

        $this->configureWeekDays($this->config);
    }

    /**
     * Configure Week Days
     *
     * @param array $config
     * @return Week
     */
    public function configureWeekDays(array $config): self
    {
        foreach (self::DAYS as $dayNumber => $dayName) {
            $day = new Day(
                $dayNumber,
                $dayName,
                $config['days'][$dayName]['business_day'] ?? false,
                $config['days'][$dayName]['office_hours_start'] ?? $config['office_hours_start'],
                $config['days'][$dayName]['office_hours_end'] ?? $config['office_hours_end'],
                $config['check_office_hours'],
                $config['check_office_hours_start']
            );

            $this->days->push($day);
        }

        return $this;
    }

    /**
     * Return all week days
     *
     * @param array|null $filterDays
     * @return Collection
     */
    public function getDays(?array $filterDays = []): Collection
    {
        if (empty($filterDays)) {
            return $this->days;
        }

        return $this->days->whereIn('name', $filterDays)->values();
    }

    /**
     * Return a Day instance from a given week day name
     *
     * @param string $name
     * @return Day
     */
    public function getDayByWeekDayName(string $name): Day
    {
        return $this
            ->getDays()
            ->where('name', '=', $name)
            ->first();
    }

    /**
     * Return a Day instance from a given week day number
     *
     * @param int $number
     * @return Day
     */
    public function getDayByWeekDayNumber(int $number): Day
    {
        return $this
            ->getDays()
            ->where('number', '=', $number)
            ->first();
    }

    /**
     * Return a instance of a Day
     *
     * @param DateTime $date
     * @return Day
     */
    public function getWeekDayByDateTime(DateTime $date): Day
    {
        return $this
            ->getDays()
            ->where('number', '=', $date->format("w"))
            ->first();
    }

}
