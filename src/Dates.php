<?php

declare(strict_types=1);

namespace Joaosalless\Dates;

use DateTime;
use Exception;
use Illuminate\Support\Collection;
use Joaosalless\Dates\Service\DataService;

/**
 * Class Dates
 *
 * @package Joaosalless\Dates
 */
class Dates
{
    /**
     * @var DataService
     */
    private $dataService;

    /**
     * Dates constructor.
     *
     * @param string $country
     * @throws Exception
     */
    public function __construct(string $country)
    {
        $this->dataService = new DataService($country);
    }

    /**
     * @param string $iso
     * @throws Exception
     */
    public function setCountry(string $iso)
    {
        $this->dataService->setIso($iso);
    }

    /**
     * Return a events collection
     *
     * @param string $date
     * @param string|null $state
     * @param string|null $city
     * @param bool $grouped
     *
     * @return Collection
     * @throws Exception
     */
    public function getEvents(
        $date = 'now',
        ?string $state = null,
        ?string $city = null,
        bool $grouped = false
    ): Collection {
        $this->dataService->build($date, $state, $city, $grouped);

        return $this->dataService->getEvents();
    }

    /**
     * Return a commemorative dates collection
     *
     * @param string $date
     * @param string|null $state
     * @param string|null $city
     * @param bool|null $grouped
     *
     * @return Collection
     * @throws Exception
     */
    public function getCommemorativeDates(
        $date = 'now',
        ?string $state = null,
        ?string $city = null,
        ?bool $grouped = true
    ): Collection {
        return $this->dataService->getCommemorativeDates($date, $state, $city, $grouped);
    }

    /**
     * Return a holidays collection
     *
     * @param string $date
     * @param string|null $state
     * @param string|null $city
     * @param bool|null $grouped
     *
     * @return Collection
     * @throws Exception
     */
    public function getHolidays(
        $date = 'now',
        ?string $state = null,
        ?string $city = null,
        ?bool $grouped = true
    ): Collection {
        return $this->dataService->getHolidays($date, $state, $city, $grouped);
    }

    /**
     * Checks if exists holiday in a given date
     *
     * This method can be used to check whether a specific date is a run
     * in a specified country, state and city
     *
     * @param string|DateTime $date
     * @param string|null $state
     * @param string|null $city
     * @param bool|null $grouped
     *
     * @return bool
     * @throws Exception
     */
    public function isHoliday(
        $date = 'now',
        ?string $state = null,
        ?string $city = null,
        ?bool $grouped = false
    ) {
        return $this->dataService->isHoliday($date, $state, $city, $grouped);
    }

    /**
     * Calculates business days from a start date and a specified number of days
     *
     * @param int $days
     * @param string|null $date
     * @param string|null $state
     * @param string|null $city
     *
     * @return DateTime
     * @throws Exception
     */
    public function calculateBusinessDays(
        int $days,
        ?string $date = 'now',
        ?string $state = null,
        ?string $city = null
    ): DateTime {
        return $this->dataService->calculateBusinessDays($days, $date, $state, $city);
    }

    /**
     * Check if day is a business day
     *
     * @param DateTime|string $dateTime
     * @return bool
     * @throws Exception
     */
    public function isBusinessDay($dateTime): bool
    {
        return $this->dataService->isBusinessDay($dateTime);
    }

    /**
     * Verify if given time is office hour
     *
     * @param DateTime|string $dateTime
     * @return bool
     * @throws Exception
     */
    public function isOfficeHour($dateTime): bool
    {
        return $this->dataService->isOfficeHour($dateTime);
    }

}
