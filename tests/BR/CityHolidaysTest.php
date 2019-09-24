<?php

declare(strict_types=1);

namespace Joaosalless\Dates\BR;

use Joaosalless\Dates\DatesTest;

class CityHolidaysTest extends DatesTest
{
    protected $country = 'BR';

    /**
     * City holidays
     *
     * @return array
     */
    public function eventsProvider(): array
    {
        return [
            // São Paulo - SP
            ['2019-01-25', 'SP', '3550308', ['region' => 'CITY', 'name' => 'Feriado municipal']],
        ];
    }
}
