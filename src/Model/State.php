<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

/**
 * Class State
 *
 * @package Joaosalless\Dates\Model
 */
class State extends Model
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $name;

    /**
     * State constructor.
     * @param string $id
     * @param string $code
     * @param string $name
     */
    public function __construct(
        string $id,
        string $code,
        string $name
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
