<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

use DateTime;

/**
 * Class Week
 *
 * @package Joaosalless\Dates\Model
 */
class WorkDays
{
    private $weekWorkDays;

    /**
     * WorkDays constructor.
     *
     * @param array $weekWorkDays
     */
    public function __construct(array $weekWorkDays)
    {
        $this->weekWorkDays = $weekWorkDays;
    }

    /**
     * @param DateTime $date
     * @return bool
     */
    public function isWorkDay(DateTime $date): bool
    {
        return $this->weekWorkDays[$date->format("w")];
    }
}
