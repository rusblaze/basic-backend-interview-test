<?php
namespace Rusblaze\ApiBundle\Dto;

use JMS\Serializer\Annotation\Type;

class NeoListPage
{
    private $links;
    private $near_earth_objects;

    /**
     * @return mixed
     */
    public function getNeo()
    {
        return $this->near_earth_objects;
    }
}