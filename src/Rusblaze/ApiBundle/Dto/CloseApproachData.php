<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 28.08.17
 * Time: 18:03
 */

namespace Rusblaze\ApiBundle\Dto;

class CloseApproachData
{
    /**
     * @var RelativeVelocity
     */
    private $relative_velocity;

    /**
     * @return RelativeVelocity
     */
    public function getRelativeVelocity(): RelativeVelocity
    {
        return $this->relative_velocity;
    }
}