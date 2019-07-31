<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

use DateTime;
use Exception;
use Illuminate\Support\Collection;

/**
 * Class Event
 *
 * @package Joaosalless\Dates\Model
 */
class Event extends Model
{
    const DATE_FORMAT = 'Y-m-d';
    const DATE_TYPE_FIXED = 'fixed';
    const DATE_TYPE_EASTER_SUNDAY = 'easter_sunday';
    const DATE_TYPE_VARIABLE_YEAR_STRING = 'variable_year_string';
    const region_NATIONAL = 'national';
    const REGION_STATE = 'state';
    const REGION_CITY = 'city';
    const EVENT_TYPE_HOLIDAY = 'holiday';
    const EVENT_TYPE_COMMEMORATIVE_DATE = 'commemorative_date';

    /**
     * @var DateTime
     */
    private $datetime;

    /**
     * @var string
     */
    public $event_type;

    /**
     * @var string
     */
    public $region;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string|null
     */
    public $state;

    /**
     * @var string|null
     */
    public $city;

    /**
     * @var string
     */
    public $date_type;

    /**
     * @var string
     */
    public $date;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string|null
     */
    public $description;

    /**
     * @var bool
     */
    public $optional;

    /**
     * @var Collection
     */
    public $states;

    /**
     * @var Collection
     */
    public $cities;

    /**
     * @var int
     */
    public $sort_value = 0;

    /**
     * Event constructor.
     *
     * @param int $year
     * @param string $event_type
     * @param string $region
     * @param string $country
     * @param string|null $state
     * @param string|null $city
     * @param string $date_type
     * @param string $date
     * @param string $name
     * @param string|null $description
     * @param bool $optional
     *
     * @throws Exception
     */
    public function __construct(
        int $year,
        string $event_type,
        string $region,
        string $country,
        ?string $state,
        ?string $city,
        string $date_type,
        string $date,
        string $name,
        ?string $description,
        bool $optional
    ) {
        $this->datetime = $this->getEventDateTime($year, $date, $date_type);
        $this->event_type = $event_type;
        $this->region = $region;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->date_type = $date_type;
        $this->date = $this->getDateTime()->format(self::DATE_FORMAT);
        $this->name = $name;
        $this->description = $description;
        $this->optional = $optional;
        $this->states = collect();
        $this->cities = collect();
        $this->sort_value = $this->getSortValue();
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getDateTime(): DateTime
    {
        return $this->datetime;
    }

    /**
     * @param int $year
     * @param string $date
     * @param string $date_type
     *
     * @return DateTime
     * @throws Exception
     */
    private function getEventDateTime(int $year, string $date, string $date_type): DateTime
    {
        // Return DateTime instance created by variable string
        if ($date_type === self::DATE_TYPE_VARIABLE_YEAR_STRING) {
            return (new DateTime(sprintf($date, (string) $year)));
        }

        // Return DateTime instance created by easter sunday variable diff in days
        if ($date_type === self::DATE_TYPE_EASTER_SUNDAY) {
            return $this->getVariableDateByEasterSunday($year, $date);
        }

        // Return DateTime instance created by fixed date
        return (new DateTime("{$year}-{$date}"));
    }

    /**
     * @param int $year
     * @param string $date
     *
     * @return DateTime
     * @throws Exception
     */
    private function getVariableDateByEasterSunday(int $year, string $date): DateTime
    {
        $easterSunday = $this->getEasterSunday($year);

        return $easterSunday->modify($date);
    }

    /**
     * Returns easter sunday
     *
     * @param int $year
     * @param boolean $orthodox
     *
     * @return DateTime
     * @throws Exception
     */
    private function getEasterSunday(int $year, $orthodox = false): DateTime
    {
        if (!$year) {
            $year  = date('Y');
        }
        $easterSunday = $orthodox ? $this->createOrthodoxSunday($year) :  $this->createSunday($year);
        $easterSunday->setTimezone(new \DateTimeZone(date_default_timezone_get()));

        return $easterSunday;
    }

    /**
     * Creating easter sunday
     *
     * @param $year
     * @return DateTime
     * @throws Exception
     */
    private function createSunday(int $year)
    {
        return (new DateTime("{$year}-03-21"))->modify(sprintf('+%d days', easter_days($year)));
    }

    /**
     * Creating Orthodox easter sunday
     *
     * @param $year
     * @return DateTime
     * @throws Exception
     */
    private function createOrthodoxSunday($year)
    {
        $a = $year % 4;
        $b = $year % 7;
        $c = $year % 19;
        $d = (19 * $c + 15) % 30;
        $e = (2 * $a + 4 * $b - $d + 34) % 7;
        $month = floor(($d + $e + 114) / 31);
        $day = (($d + $e + 114) % 31) + 1;

        $sunday = mktime(0, 0, 0, $month, $day + 13, $year);

        return new DateTime(date('Y-m-d', $sunday));
    }

    /**
     * @return Collection
     */
    public function getStates(): Collection
    {
        return $this->states;
    }

    /**
     * @return Collection
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    /**
     * Return sort value for events
     *
     * @return int
     */
    private function getSortValue(): int
    {
        if ($this->region === Event::REGION_STATE) {
            return 1;
        }

        if ($this->region === Event::REGION_CITY) {
            return 2;
        }

        // Default sort value for national events
        return 0;
    }

}
