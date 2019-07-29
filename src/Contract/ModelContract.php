<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Contract;

/**
 * Interface ModelContract
 *
 * @package Joaosalless\Dates\Model
 */
interface ModelContract
{
    /**
     * Serializes model to Array
     *
     * @return array
     */
    public function toArray(): array;
}
