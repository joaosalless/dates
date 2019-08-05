<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

/**
 * Class City
 *
 * @package Joaosalless\Dates\Model
 */
class City extends Model
{
    /**
     * @var string
     */
    public $state_code;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $name;

    /**
     * City constructor.
     *
     * @param string $state_code
     * @param string $code
     * @param string $name
     */
    public function __construct(
        string $state_code,
        string $code,
        string $name
    ) {
        $this->state_code = $state_code;
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getStateCode(): string
    {
        return $this->state_code;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}
