<?php

declare(strict_types=1);

namespace Joaosalless\Dates\Model;

/**
 * Class Iso
 *
 * @package Joaosalless\Dates\Model
 */
class Iso extends Model
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $alpha_code_2;

    /**
     * @var string
     */
    public $alpha_code_3;

    /**
     * @var string
     */
    public $country_code;

    /**
     * @var string
     */
    public $iso_3166_2;

    /**
     * @var string
     */
    public $region;

    /**
     * @var string
     */
    public $sub_region;

    /**
     * @var string
     */
    public $intermediate_region;

    /**
     * @var string
     */
    public $region_code;

    /**
     * @var string
     */
    public $sub_region_code;

    /**
     * @var string
     */
    public $intermediate_region_code;

    /**
     * Iso constructor.
     *
     * @param string $name
     * @param string $alpha_code_2
     * @param string $alpha_code_3
     * @param string $country_code
     * @param string $iso_3166_2
     * @param string|null $region
     * @param string|null $sub_region
     * @param string|null $intermediate_region
     * @param string|null $region_code
     * @param string|null $sub_region_code
     * @param string|null $intermediate_region_code
     */
    public function __construct(
        string $name,
        string $alpha_code_2,
        string $alpha_code_3,
        string $country_code,
        string $iso_3166_2,
        ?string $region,
        ?string $sub_region,
        ?string $intermediate_region,
        ?string $region_code,
        ?string $sub_region_code,
        ?string $intermediate_region_code
    ) {
        $this->name = $name;
        $this->alpha_code_2 = $alpha_code_2;
        $this->alpha_code_3 = $alpha_code_3;
        $this->country_code = $country_code;
        $this->iso_3166_2 = $iso_3166_2;
        $this->region = $region;
        $this->sub_region = $sub_region;
        $this->intermediate_region = $intermediate_region;
        $this->region_code = $region_code;
        $this->sub_region_code = $sub_region_code;
        $this->intermediate_region_code = $intermediate_region_code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->getAlphaCode2();
    }

    /**
     * @return string
     */
    public function getAlphaCode2(): string
    {
        return $this->alpha_code_2;
    }

    /**
     * @return string
     */
    public function getAlphaCode3(): string
    {
        return $this->alpha_code_3;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->country_code;
    }

    /**
     * @return string
     */
    public function getIso31662(): string
    {
        return $this->iso_3166_2;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getSubRegion(): string
    {
        return $this->sub_region;
    }

    /**
     * @return string
     */
    public function getIntermediateRegion(): string
    {
        return $this->intermediate_region;
    }

    /**
     * @return string
     */
    public function getRegionCode(): string
    {
        return $this->region_code;
    }

    /**
     * @return string
     */
    public function getSubRegionCode(): string
    {
        return $this->sub_region_code;
    }

    /**
     * @return string
     */
    public function getIntermediateRegionCode(): string
    {
        return $this->intermediate_region_code;
    }

}
