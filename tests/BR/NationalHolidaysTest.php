<?php

declare(strict_types=1);

namespace Joaosalless\Dates\BR;

use Joaosalless\Dates\DatesTest;

class NationalHolidaysTest extends DatesTest
{
    protected $country = 'BR';

    /**
     * National holidays
     *
     * @return array
     */
    public function eventsProvider(): array
    {
        return [
            // National Static
            ['2017-01-01', null, null, ['region' => 'NATIONAL', 'name' => 'Confraternização Universal']],
            ['2017-04-21', null, null, ['region' => 'NATIONAL', 'name' => 'Tiradentes']],
            ['2017-05-01', null, null, ['region' => 'NATIONAL', 'name' => 'Dia do Trabalhador']],
            ['2017-09-07', null, null, ['region' => 'NATIONAL', 'name' => 'Dia da Pátria']],
            ['2017-10-12', null, null, ['region' => 'NATIONAL', 'name' => 'Nossa Senhora Aparecida']],
            ['2017-11-02', null, null, ['region' => 'NATIONAL', 'name' => 'Finados']],
            ['2017-11-15', null, null, ['region' => 'NATIONAL', 'name' => 'Proclamação da República']],
            ['2017-12-25', null, null, ['region' => 'NATIONAL', 'name' => 'Natal']],
            // National Variable
            ['2016-02-09', null, null, ['region' => 'NATIONAL', 'name' => 'Carnaval']],
            ['2017-02-28', null, null, ['region' => 'NATIONAL', 'name' => 'Carnaval']],
            ['2018-02-13', null, null, ['region' => 'NATIONAL', 'name' => 'Carnaval']],
            ['2016-03-25', null, null, ['region' => 'NATIONAL', 'name' => 'Sexta-Feira Santa']],
            ['2017-04-14', null, null, ['region' => 'NATIONAL', 'name' => 'Sexta-Feira Santa']],
            ['2018-03-30', null, null, ['region' => 'NATIONAL', 'name' => 'Sexta-Feira Santa']],
            ['2016-05-26', null, null, ['region' => 'NATIONAL', 'name' => 'Corpus Christi']],
            ['2017-06-15', null, null, ['region' => 'NATIONAL', 'name' => 'Corpus Christi']],
            ['2018-05-31', null, null, ['region' => 'NATIONAL', 'name' => 'Corpus Christi']],
        ];
    }
}
