<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 28.08.17
 * Time: 17:56
 */

namespace Rusblaze\CoreDomain\Neo;

class Neo
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $speed;

    /**
     * @var bool
     */
    private $isHazardous;

    /**
     * Neo constructor.
     *
     * @param \DateTime $date
     * @param string    $reference
     * @param string    $name
     * @param float     $speed
     * @param bool      $isHazardous
     */
    public function __construct(\DateTime $date, $reference, $name, $speed, $isHazardous)
    {
        $this->date        = $date;
        $this->reference   = $reference;
        $this->name        = $name;
        $this->speed       = $speed;
        $this->isHazardous = $isHazardous;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * @return bool
     */
    public function isHazardous(): bool
    {
        return $this->isHazardous;
    }
}