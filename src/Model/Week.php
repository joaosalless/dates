<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

use DateTime;

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
                'business_day' => true,
            ],
        ]
    ];

    /**
     * @var array
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
        foreach (self::DAYS as $dayNumber => $day) {
            $this->days[$day] = new Day(
                $day,
                $config['days'][$day]['business_day'] ?? $config['business_day'],
                $config['days'][$day]['office_hours_start'] ?? $config['office_hours_start'],
                $config['days'][$day]['office_hours_end'] ?? $config['office_hours_end'],
                $config['check_office_hours'],
                $config['check_office_hours_start']
            );
        }

        return $this;
    }

    /**
     * Return a Day instance from a given week day name
     *
     * @param string $name
     * @return Day
     */
    public function getDayByWeekDayName(string $name): Day
    {
        return $this->days[$name];
    }

    /**
     * Return a Day instance from a given week day number
     *
     * @param string $name
     * @return Day
     */
    public function getDayByWeekDayNumber(string $name): Day
    {
        return $this->days[$name];
    }

    /**
     * Return a instance of a Day
     *
     * @param DateTime $date
     * @return Day
     */
    public function getWeekDayByDateTime(DateTime $date): Day
    {
        return $this->days[self::DAYS[$date->format("w")]];
    }

    /**
     * Return week configuration
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

}
