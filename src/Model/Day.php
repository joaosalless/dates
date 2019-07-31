<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

use DateTime;
use Exception;

/**
 * Class Day
 *
 * @package Joaosalless\Dates\Model
 */
class Day extends Model
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $business_day;

    /**
     * @var string|null
     */
    private $office_hours_start;

    /**
     * @var string|null
     */
    private $office_hours_end;

    /**
     * @var bool|null
     */
    private $check_office_hours;

    /**
     * @var bool|null
     */
    private $check_office_hours_start;

    /**
     * Day constructor.
     *
     * @param string $name
     * @param bool $business_day
     * @param string|null $office_hours_start
     * @param string|null $office_hours_end
     * @param bool|null $check_office_hours
     * @param bool|null $check_office_hours_start
     */
    public function __construct(
        string $name,
        bool $business_day,
        ?string $office_hours_start = null,
        ?string $office_hours_end = null,
        ?bool $check_office_hours = false,
        ?bool $check_office_hours_start = true
    ) {
        $this->name = $name;
        $this->business_day = $business_day;
        $this->office_hours_start = $office_hours_start;
        $this->office_hours_end = $office_hours_end;
        $this->check_office_hours = $check_office_hours;
        $this->check_office_hours_start = $check_office_hours_start;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isBusinessDay(): bool
    {
        return $this->business_day;
    }

    /**
     * @return string|null
     */
    public function getOfficeHoursStart(): ?string
    {
        return $this->office_hours_start;
    }

    /**
     * @return string|null
     */
    public function getOfficeHoursEnd(): ?string
    {
        return $this->office_hours_end;
    }

    /**
     * @return bool|null
     */
    public function getCheckOfficeHours(): ?bool
    {
        return $this->check_office_hours;
    }

    /**
     * @return bool|null
     */
    public function getCheckOfficeHoursStart(): ?bool
    {
        return $this->check_office_hours_start;
    }

    /**
     * Verify if given time is office hour
     *
     * @param DateTime|null $dateTime
     * @return bool
     * @throws Exception
     */
    public function isOfficeHour(DateTime $dateTime): bool
    {
        $office_hours_start = new DateTime("{$dateTime->format('Y-m-d')} $this->office_hours_start");
        $office_hours_end = new DateTime("{$dateTime->format('Y-m-d')} $this->office_hours_end");

        if (!$this->check_office_hours_start) {
            return $dateTime < $office_hours_end;
        }

        return $dateTime > $office_hours_start && $dateTime < $office_hours_end;
    }

}
