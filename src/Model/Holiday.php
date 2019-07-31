<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

use Exception;
use Illuminate\Support\Collection;

/**
 * Class Holiday
 */
class Holiday extends Model
{
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
     * @var int
     */
    public $sort_value = 0;

    /**
     * Event constructor.
     *
     * @param string $region
     * @param string $country
     * @param string|null $state
     * @param string|null $city
     * @param string $date
     * @param string $name
     * @param string|null $description
     * @param bool $optional
     *
     * @throws Exception
     */
    public function __construct(
        string $region,
        string $country,
        ?string $state,
        ?string $city,
        string $date,
        string $name,
        ?string $description,
        bool $optional
    ) {
        $this->region = $region;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->date = $date;
        $this->name = $name;
        $this->description = $description;
        $this->optional = $optional;
        $this->sort_value = $this->getSortValue();
    }

    /**
     * @param array $data
     * @return Holiday
     * @throws Exception
     */
    public static function create(array $data): self
    {
        return new self(
            $data['region'],
            $data['country'],
            $data['state'],
            $data['city'],
            $data['date'],
            $data['name'],
            $data['description'],
            $data['optional']
        );
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
