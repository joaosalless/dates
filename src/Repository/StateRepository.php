<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Repository;

use Joaosalless\Dates\Model\State;
use Joaosalless\Dates\Service\DataService;

/**
 * Class StateRepository
 *
 * @package Joaosalless\Dates\Repository
 */
class StateRepository extends CsvRepository
{
    /**
     * @var string
     */
    protected $model = State::class;

    /**
     * @var string
     */
    protected $filename = 'states';

    /**
     * Load the csv data
     */
    public function loadData(): void
    {
        foreach ($this->csv->fetchAssoc() as $item) {
            $this->data->push(new $this->model(
                $this->setStringProperty($item['id']),
                $this->setStringProperty($item['code']),
                $this->setStringProperty($item['name'])
            ));
        }
    }

    /**
     * Return a State instance
     *
     * @param string $code
     * @return State|null
     */
    public function getFirstByCode(string $code): ?State
    {
        return $this
            ->getAll()
            ->where('code', '=', $code)
            ->first();
    }
}
