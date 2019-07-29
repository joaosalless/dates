<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

use Joaosalless\Dates\Contract\ModelContract;

/**
 * Class Model
 *
 * @package Joaosalless\Dates\Model
 */
abstract class Model implements ModelContract
{
    /**
     * Serializes model to Array
     *
     * @return array
     */
    public function toArray(): array
    {
        return (array) $this;
    }
}
