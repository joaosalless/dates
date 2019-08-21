<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Repository;

use Illuminate\Support\Collection;
use Joaosalless\Dates\Model\Builder;
use Joaosalless\Dates\Model\Model;
use Joaosalless\Dates\Service\DataService;
use League\Csv\Reader;

/**
 * Class CsvRepository
 *
 * @package Joaosalless\Dates\Repository
 */
abstract class CsvRepository extends BaseRepository
{
    /**
     * @var Reader
     */
    protected $csv;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Collection
     */
    protected $data;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var string
     */
    protected $dataType = DataService::DATA_TYPE_CSV;

    /**
     * CsvRepository constructor.
     *
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
        $this->data = collect();
        $this->builder = $builder;
        $this->csv = Reader::createFromPath($this->filePath(), 'r');
        $this->loadData();
    }
}
