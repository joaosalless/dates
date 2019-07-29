<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Test;

use Joaosalless\Dates\Dates;

class DatesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Dates
     */
    protected $datesService;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $this->datesService = new Dates('BR');
    }
}
