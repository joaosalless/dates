<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Service;

use DateTime;
use Exception;
use Illuminate\Support\Collection;
use Joaosalless\Dates\Model\Builder;
use Joaosalless\Dates\Model\WorkDate;
use Joaosalless\Dates\Model\WorkDays;
use Joaosalless\Dates\Repository\CityRepository;
use Joaosalless\Dates\Repository\EventRepository;
use Joaosalless\Dates\Repository\IsoRepository;
use Joaosalless\Dates\Repository\StateRepository;

/**
 * Class DataService
 *
 * @package Joaosalless\Dates\Service
 */
class DataService
{
    const DATA_TYPE_CSV = 'CSV';
    const DATA_TYPE_JSON = 'JSON';

    /**
     * @var string
     */
    private $dataType = self::DATA_TYPE_CSV;

    /**
     * @var Builder
     */
    private $builder;

    /**
     * @var IsoRepository
     */
    private $isoRepository;

    /**
     * @var StateRepository
     */
    private $stateRepository;

    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * DataService constructor.
     *
     * @param string $iso
     *
     * @throws Exception
     */
    public function __construct(string $iso)
    {
        // Start ISO repository
        $this->isoRepository = new IsoRepository();

        $workDays = new WorkDays([
            0 => false,
            1 => true,
            2 => true,
            3 => true,
            4 => true,
            5 => true,
            6 => false,
        ]);

        // Start Builder
        $this->builder = new Builder(
            $this->isoRepository->getIsoByCode($this->formatIsoCode($iso)),
            $workDays,
            $this->dataType,
            null,
            null,
            null
        );

        // Start State Repository
        $this->stateRepository = new StateRepository($this->builder);

        // Start City Repository
        $this->cityRepository = new CityRepository($this->builder);
    }

    /**
     * Defines the work days to be used in the query
     *
     * @param array $workDays
     * @return DataService
     */
    public function setWorkDays(array $workDays): self
    {
        $this->builder->setWorkDays(new WorkDays($workDays));

        return $this;
    }

    /**
     * Defines the date to be used in the query
     *
     * @param string|DateTime $date
     * @return DataService
     * @throws Exception
     */
    public function setDate($date): self
    {
        $filterDate = $date === 'now' ? false : true;

        $this->builder
            ->setDate($this->formatDate($date))
            ->setFilterDate($filterDate);

        return $this;
    }

    /**
     * Defines the ISO to be used in the query
     *
     * @param string $iso
     * @return DataService
     * @throws Exception
     */
    public function setIso(string $iso): self
    {
        $isoInstance = $this->isoRepository->getIsoByCode($this->formatIsoCode($iso));

        $this->builder->setIso($isoInstance);

        return $this;
    }

    /**
     * Defines the state to be used in the query
     *
     * @param string|null $state
     * @return DataService
     * @throws Exception
     */
    public function setState(?string $state): self
    {
        $stateInstance = $state ? $this->stateRepository->getFirstByCode($state) : null;
        $filterState = $stateInstance ? true : false;

        $this->builder
            ->setFilterState($filterState)
            ->setState($stateInstance);

        return $this;
    }

    /**
     * Defines the city to be used in the query
     *
     * @param string|null $city
     * @return DataService
     * @throws Exception
     */
    public function setCity(?string $city): self
    {
        $cityInstance = $city ? $this->cityRepository->getFirstByCode($city) : null;
        $filterCity = $cityInstance ? true : false;

        $this->builder
            ->setFilterCity($filterCity)
            ->setCity($cityInstance);

        return $this;
    }

    /**
     * @param bool|null $grouped
     * @return DataService
     */
    private function setGrouped(?bool $grouped): self
    {
        $this->builder->setGrouped($grouped);

        return $this;
    }

    /**
     * @param string|DateTime $date
     * @param string|null $state
     * @param string|null $city
     * @param bool $grouped
     *
     * @return $this
     * @throws Exception
     */
    public function build(
        $date = 'now',
        ?string $state = null,
        ?string $city = null,
        bool $grouped = false
    ): self {
        $this
            ->setDate($date)
            ->setState($state)
            ->setCity($city)
            ->setGrouped($grouped);

        // Start Event Repository
        $this->eventRepository = new EventRepository($this->builder);

        return $this;
    }

    /**
     * @return Builder
     */
    public function getBuilder(): Builder
    {
        return $this->builder;
    }

    /**
     * @return EventRepository
     */
    public function getEventRepository(): EventRepository
    {
        return $this->eventRepository;
    }

    /**
     * Return a DateTime instance
     *
     * @param $date
     * @return DateTime
     * @throws Exception
     */
    private function formatDate($date): DateTime
    {
        if (!$date instanceof DateTime) {
            return new DateTime($date);
        }

        return $date;
    }

    /**
     * Return a formatted iso code string
     *
     * @param string $iso
     * @return string
     */
    protected function formatIsoCode(string $iso): string
    {
        return strtoupper($iso);
    }

    /**
     * Return events collection
     *
     * @param string|DateTime $date
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
        $this->build($date, $state, $city, $grouped);

        return $this
            ->getEventRepository()
            ->getAll();
    }

    /**
     * Return events collection
     *
     * @param string|DateTime $date
     * @param string|null $state
     * @param string|null $city
     * @param bool $grouped
     * @return Collection
     * @throws Exception
     */
    public function getCommemorativeDates(
        $date = 'now',
        ?string $state = null,
        ?string $city = null,
        bool $grouped = false
    ): Collection {
        $this->build($date, $state, $city, $grouped);

        return $this
            ->getEventRepository()
            ->getCommemorativeDates();
    }

    /**
     * @param string|DateTime $date
     * @param string|null $state
     * @param string|null $city
     * @param bool $grouped
     * @return Collection
     * @throws Exception
     */
    public function getHolidays(
        $date = 'now',
        ?string $state = null,
        ?string $city = null,
        bool $grouped = false
    ): Collection {
        $this->build($date, $state, $city, $grouped);

        return $this
            ->getEventRepository()
            ->getHolidays();
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
     * @param bool $grouped
     *
     * @return bool
     * @throws Exception
     */
    public function isHoliday(
        $date = 'now',
        ?string $state = null,
        ?string $city = null,
        bool $grouped = false
    ) {
        return ($this->getHolidays($date, $state, $city, $grouped)->count() > 0);
    }

    /**
     * @param int $workDays
     * @param $date
     * @param string|null $state
     * @param string|null $city
     *
     * @return DateTime
     * @throws Exception
     */
    public function getWorkDate(int $workDays, $date, ?string $state, ?string $city): DateTime
    {
        $workDaysCount = 0;
        $date = $this->formatDate($date);

        while ($workDaysCount < $workDays) {

            if ($this->isHoliday($date, $state, $city, false)) {
                $date->modify('+1 days');
            }

            if (!$this->isWorkDay($date)) {
                $date->modify('+1 days');
            }

            $date->modify('+1 days');

            $workDaysCount++;
        }

        return $date;
    }

    /**
     * Check if day is saturday or sunday
     *
     * @param DateTime $date
     * @return bool
     */
    private function isWorkDay(DateTime $date): bool
    {
        return $this
            ->getBuilder()
            ->getWorkDays()
            ->isWorkDay($date);
    }

}
