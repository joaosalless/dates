<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

use DateTime;

/**
 * Class Builder
 *
 * @package Joaosalless\Dates\Model
 */
class Builder extends Model
{
    /**
     * @var Iso
     */
    private $iso;

    /**
     * @var Week
     */
    private $week;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var State
     */
    private $state;

    /**
     * @var City
     */
    private $city;

    /**
     * @var bool
     */
    public $filter_date;

    /**
     * @var bool
     */
    private $filter_state;

    /**
     * @var bool
     */
    private $filter_city;

    /**
     * @var bool|null
     */
    private $grouped;

    /**
     * Builder constructor.
     *
     * @param Iso $iso
     * @param Week $week
     * @param DateTime|null $date
     * @param State|null $state
     * @param City|null $city
     * @param bool|null $filter_date
     * @param bool|null $filter_state
     * @param bool|null $filter_city
     */
    public function __construct(
        Iso $iso,
        Week $week,
        ?DateTime $date = null,
        ?State $state = null,
        ?City $city = null,
        ?bool $filter_date = null,
        ?bool $filter_state = null,
        ?bool $filter_city = null
    ) {
        $this->iso = $iso;
        $this->date = $date;
        $this->state = $state;
        $this->city = $city;
        $this->filter_date = $filter_date;
        $this->filter_state = $filter_state;
        $this->filter_city = $filter_city;
        $this->week = $week;
    }

    /**
     * @return Iso|null
     */
    public function getIso(): ?Iso
    {
        return $this->iso;
    }

    /**
     * @param Iso|null $iso
     * @return Builder
     */
    public function setIso(?Iso $iso): self
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        if (!$this->getDate()) {
            return null;
        }

        return intval($this->getDate()->format('Y'));
    }

    /**
     * @param DateTime|null $date
     * @return Builder
     */
    public function setDate(?DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return State|null
     */
    public function getState(): ?State
    {
        return $this->state;
    }

    /**
     * @return City|null
     */
    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * Return de country data path
     *
     * @return string
     */
    public function getDataPath(): string
    {
        if (!$this->getIso()) {
            return realpath(__DIR__ . "/../Data");
        }

        return realpath(__DIR__ . "/../Data/{$this->getIso()->getCode()}");
    }

    /**
     * @param State|null $state
     * @return Builder
     */
    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @param City|null $city
     * @return Builder
     */
    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
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
     * @return Builder
     */
    public function setFilterDate(bool $filter_date): Builder
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
     * @return Builder
     */
    public function setFilterState(bool $filter_state): Builder
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
     * @return Builder
     */
    public function setFilterCity(bool $filter_city): Builder
    {
        $this->filter_city = $filter_city;

        return $this;
    }

    public function setGrouped(?bool $grouped)
    {
        $this->grouped = $grouped;
    }

    /**
     * @return bool|null
     */
    public function getGrouped(): ?bool
    {
        return $this->grouped;
    }

    /**
     * @return Week
     */
    public function getWeek(): Week
    {
        return $this->week;
    }

    /**
     * @param Week $week
     * @return Builder
     */
    public function setWeek(Week $week): self
    {
        $this->week = $week;

        return $this;
    }

}
