<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 28.08.17
 * Time: 17:36
 */

namespace Rusblaze\ApiBundle\Dto;

class Neo
{
    /**
     * @var bool
     */
    private $is_potentially_hazardous_asteroid;

    /**
     * @var string
     */
    private $neo_reference_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var CloseApproachData[]
     */
    private $close_approach_data;

    /**
     * @return bool
     */
    public function isPotentiallyHazardousAsteroid(): bool
    {
        return $this->is_potentially_hazardous_asteroid;
    }

    /**
     * @return string
     */
    public function getNeoReferenceId(): string
    {
        return $this->neo_reference_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return CloseApproachData[]
     */
    public function getCloseApproachData(): array
    {
        return $this->close_approach_data;
    }

    /**
     * @return CloseApproachData
     */
    public function getLastCloseApproachData(): CloseApproachData
    {
        return $this->close_approach_data[0];
    }
}