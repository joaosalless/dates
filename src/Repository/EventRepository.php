<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Repository;

use Exception;
use Illuminate\Support\Collection;
use Joaosalless\Dates\Model\Event;
use Joaosalless\Dates\Model\Holiday;

/**
 * Class EventRepository
 *
 * @package Joaosalless\Dates\Repository
 */
class EventRepository extends CsvRepository
{
    /**
     * @var string
     */
    protected $model = Event::class;

    /**
     * @var string
     */
    protected $filename = 'events';

    /**
     * Load the csv data
     *
     * @throws Exception
     */
    public function loadData(): void
    {
        foreach ($this->csv->fetchAssoc() as $item) {
            $this->push(new Event(
                $this->getBuilder()->getYear(),
                $this->setStringProperty($item['event_type']),
                $this->setStringProperty($item['region']),
                $this->setStringProperty($item['country']),
                $this->setStringProperty($item['state']),
                $this->setStringProperty($item['city_code']),
                $this->setStringProperty($item['city_name']),
                $this->setStringProperty($item['date_type']),
                $this->setStringProperty($item['date']),
                $this->setStringProperty($item['name']),
                $this->setStringProperty($item['description']),
                $this->setBooleanProperty($item['optional']),
                $this->setBooleanProperty($item['source'])
            ));
        }
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        $eventsResult = collect();

        // City events
        if ($this->getBuilder()->isFilterCity()) {
            $eventsResult = $eventsResult->merge($this->getCityEvents());
        }

        // State events
        if ($this->getBuilder()->isFilterState()) {
            $eventsResult = $eventsResult->merge($this->getStateEvents());
        }

        // National events
        $eventsResult = $eventsResult->merge($this->getNationalEvents());

        return $eventsResult->values();
    }

    /**
     * Return events by country
     *
     * @return Collection
     */
    private function getEventsByCountry(): Collection
    {
        $events = parent::getAll()
            ->where('country', '=', $this->getBuilder()->getIso()->getCode());

        // Filter events by date
        if ($this->getBuilder()->isFilterDate()) {
            $date = $this
                ->getBuilder()
                ->getDate()
                ->format(Event::DATE_FORMAT);

            return $events->where('date', '=', $date)->values();
        }

        return $events->values();
    }

    /**
     * Return national events
     *
     * @return Collection
     */
    private function getNationalEvents(): Collection
    {
        return $this
            ->getEventsByCountry()
            ->where('region', '=', Event::REGION_NATIONAL)
            ->where('state', '=', null)
            ->where('city_code', '=', null)
            ->values();
    }

    /**
     * Return events by state
     *
     * @return Collection
     */
    private function getStateEvents(): Collection
    {
        return $this
            ->getEventsByCountry()
            ->where('region', '=', Event::REGION_STATE)
            ->where('state', '=', $this->getBuilder()->getState()->getCode())
            ->where('city_code', '=', null)
            ->values();
    }

    /**
     * Return events by city_code
     *
     * @return Collection
     */
    private function getCityEvents(): Collection
    {
        return $this
            ->getEventsByCountry()
            ->where('region', '=', Event::REGION_CITY)
            ->where('city_code', '=', $this->getBuilder()->getCity()->getCode())
            ->values();
    }

    /**
     * @return Collection
     */
    private function getHolidaysEvents(): Collection
    {
        return $this
            ->getAll()
            ->where('event_type', '=', Event::EVENT_TYPE_HOLIDAY);
    }

    /**
     * Return a commemorative dates collection
     *
     * @return Collection
     */
    public function getCommemorativeDates(): Collection
    {
        $events = $this
            ->getAll()
            ->where('event_type', '=', Event::EVENT_TYPE_COMMEMORATIVE_DATE);

        if ($this->getBuilder()->getGrouped()) {
            $events = $events->groupBy('date');
        }

        return $events;
    }

    /**
     * Return a holiday collection
     *
     * @return Collection
     */
    public function getHolidays(): Collection
    {
        $holidays = $this
            ->getHolidaysEvents()
            ->transform(function (Event $event): Holiday {
                $holiday = Holiday::create($event->toArray());
                $holiday->type = $this->getHolidayType($holiday);
                return $holiday;
            })
            ->sortBy('date');

        if ($this->getBuilder()->getGrouped()) {
            $holidays = $holidays->groupBy('date');
        }

        return $holidays;
    }

    private function getHolidayType(Holiday $holiday): ?string
    {
        if ($holiday->region === Event::REGION_NATIONAL) {
            return 'National holiday';
        }

        if ($holiday->region === Event::REGION_STATE) {
            return 'State holiday';
        }

        if ($holiday->region === Event::REGION_CITY) {
            return 'City holiday';
        }

        return null;
    }
}
