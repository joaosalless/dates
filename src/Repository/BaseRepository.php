<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Repository;

use DateTime;
use Illuminate\Support\Collection;
use Joaosalless\Dates\Contract\ModelContract;
use Joaosalless\Dates\Model\Builder;
use Joaosalless\Dates\Model\Iso;
use Joaosalless\Dates\Model\Model;

/**
 * Class BaseRepository
 *
 * @package Joaosalless\Dates\Repository
 */
abstract class BaseRepository
{
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
    protected $dataType;

    /**
     * @return Builder
     */
    public function getBuilder(): Builder
    {
        return $this->builder;
    }

    /**
     * @return Iso
     */
    public function getIso(): ?Iso
    {
        return $this->getBuilder()->getIso();
    }

    /**
     * @return DateTime
     */
    public function getDate(): ?DateTime
    {
        return $this->getBuilder()->getDate();
    }

    /**
     * Load the csv data
     */
    public abstract function loadData(): void;

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->data;
    }

    /**
     * @param string $key
     * @param string $operator
     * @param $value
     *
     * @return Collection
     */
    public function getAllByCondition(string $key, string $operator, $value): Collection
    {
        return $this->data->where($key, $operator, $value)->values();
    }

    /**
     * @param string $key
     * @param string $operator
     * @param $value
     * @return ModelContract|null
     */
    public function getFirstByCondition(string $key, string $operator, $value): ?ModelContract
    {
        return $this->getAllByCondition($key, $operator, $value)->first();
    }

    /**
     * @param string $value
     * @return string|null
     */
    protected function setStringProperty(string $value)
    {
        return !empty($value) ? $value : null;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function setBooleanProperty($value): bool
    {
        return (bool) $value;
    }

    /**
     * @param $value
     * @return int
     */
    protected function setIntProperty($value): int
    {
        return (int) $value;
    }

    /**
     * @return string
     */
    protected function filePath(): string
    {
        return "{$this->getBuilder()->getDataPath()}/{$this->getFileName()}.{$this->getFileExtension()}";
    }

    /**
     * @return string
     */
    protected function getDataType(): string
    {
        return $this->dataType;
    }

    /**
     * @return string
     */
    protected function getFileName(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    protected function getFileExtension(): string
    {
        return strtolower($this->dataType);
    }

    /**
     * Add item
     *
     * @param ModelContract $item
     */
    public function push(ModelContract $item): void
    {
        $this->data->push($item);
    }

}
