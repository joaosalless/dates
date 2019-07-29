<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Repository;

use Joaosalless\Dates\Model\City;

/**
 * Class CityRepository
 *
 * @package Joaosalless\Dates\Repository
 */
class CityRepository extends CsvRepository
{
    /**
     * @var string
     */
    protected $model = City::class;

    /**
     * @var string
     */
    protected $filename = 'cities';

    /**
     * Load the csv data
     */
    public function loadData(): void
    {
        foreach ($this->csv->fetchAssoc() as $item) {
            $this->data->push(new $this->model(
                $this->setStringProperty($item['id']),
                $this->setStringProperty($item['state_code']),
                $this->setStringProperty($item['code']),
                $this->setStringProperty($item['name'])
            ));
        }
    }

    /**
     * Return a City instance
     *
     * @param string $code
     * @return City|null
     */
    public function getFirstByCode(string $code): ?City
    {
        return $this
            ->getAll()
            ->where('code', '=', $code)
            ->first();
    }
}
