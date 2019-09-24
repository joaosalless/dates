<?php

declare(strict_types=1);

namespace Joaosalless\Dates;

abstract class DatesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Dates
     */
    protected $datesService;

    /**
     * @var string
     */
    protected $country;

    public function setUp()
    {
        parent::setUp();

        $this->datesService = new Dates($this->getCountry());
    }

    /**
     * @return array
     */
    protected abstract function eventsProvider(): array;

    /**
     * @dataProvider eventsProvider
     *
     * @param $date
     * @param $state
     * @param $city
     * @param $event
     * @throws \Exception
     */
    public function testGetHolidays($date, $state, $city, $event)
    {
        $holiday = $this->datesService
            ->getHolidays($date, $state, $city, false)
            ->first();

        $this->assertEquals($date, $holiday->date);
        $this->assertEquals($state, $holiday->state);
        $this->assertEquals($event['name'], $holiday->name);
        $this->assertEquals($event['region'], $holiday->region);
        $this->assertEquals($this->getCountry(), $holiday->country);
    }

    /**
     * @return string
     */
    private function getCountry(): string
    {
        return $this->country;
    }
}
