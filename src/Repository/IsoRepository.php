<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Repository;

use Joaosalless\Dates\Model\Iso;
use League\Csv\Reader;

/**
 * Class IsoRepository
 *
 * @package Joaosalless\Dates\Repository
 */
class IsoRepository extends CsvRepository
{
    /**
     * @var string
     */
    protected $model = Iso::class;

    /**
     * @var string
     */
    protected $filename = 'iso';

    /**
     * IsoRepository constructor.
     */
    public function __construct()
    {
        $this->data = collect();
        $this->csv = Reader::createFromPath($this->filePath(), 'r');
        $this->loadData();
    }

    /**
     * Return a Iso instance
     *
     * @param string $code
     * @return Iso|null
     */
    public function getIsoByCode(string $code): ?Iso
    {
        return $this
            ->getAll()
            ->where('alpha_code_2', '=', $code)
            ->first();
    }

    /**
     * Load the csv data
     */
    public function loadData(): void
    {
        foreach ($this->csv->fetchAssoc() as $item) {
            $this->data->push(new Iso(
                $this->setStringProperty($item['name']),
                $this->setStringProperty($item['alpha_code_2']),
                $this->setStringProperty($item['alpha_code_3']),
                $this->setStringProperty($item['country_code']),
                $this->setStringProperty($item['iso_3166_2']),
                $this->setStringProperty($item['region']),
                $this->setStringProperty($item['sub_region']),
                $this->setStringProperty($item['intermediate_region']),
                $this->setStringProperty($item['region_code']),
                $this->setStringProperty($item['sub_region_code']),
                $this->setStringProperty($item['intermediate_region_code'])
            ));
        }
    }

    /**
     * Return country data path
     *
     * @return string
     */
    public function filePath(): string
    {
        return realpath(__DIR__ . "/../Data/{$this->getDataType()}/{$this->getFileName()}.{$this->getFileExtension()}");
    }
}
