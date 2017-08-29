<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 28.08.17
 * Time: 18:04
 */

namespace Rusblaze\ApiBundle\Dto;

class RelativeVelocity
{
    /**
     * @var float
     */
    private $kilometers_per_hour;

    /**
     * @return float
     */
    public function getKilometersPerHour(): float
    {
        return $this->kilometers_per_hour;
    }
}