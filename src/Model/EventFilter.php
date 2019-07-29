<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

/**
 * Class EventFilter
 *
 * @package Joaosalless\Dates\Model
 */
class EventFilter extends Model
{
    /**
     * @var bool
     */
    public $filter_date;

    /**
     * @var bool
     */
    public $filter_state;

    /**
     * @var bool
     */
    public $filter_city;

    /**
     * EventFilter constructor.
     *
     * @param bool $filter_date
     * @param bool $filter_state
     * @param bool $filter_city
     */
    public function __construct(bool $filter_date, bool $filter_state, bool $filter_city)
    {
        $this->filter_date = $filter_date;
        $this->filter_state = $filter_state;
        $this->filter_city = $filter_city;
    }

    /**
     * @return bool
     */
    public function isFilterDate(): bool
    {
        return $this->filter_date;
    }

    /**
     * @param bool $filter_date
     * @return EventFilter
     */
    public function setFilterDate(bool $filter_date): EventFilter
    {
        $this->filter_date = $filter_date;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFilterState(): bool
    {
        return $this->filter_state;
    }

    /**
     * @param bool $filter_state
     * @return EventFilter
     */
    public function setFilterState(bool $filter_state): EventFilter
    {
        $this->filter_state = $filter_state;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFilterCity(): bool
    {
        return $this->filter_city;
    }

    /**
     * @param bool $filter_city
     * @return EventFilter
     */
    public function setFilterCity(bool $filter_city): EventFilter
    {
        $this->filter_city = $filter_city;

        return $this;
    }
}
