<?php
namespace Rusblaze\CoreDomain\Neo;

interface NeoRepository
{
    public function add(Neo $neo): Neo;
    public function has(Neo $neo): bool;

    /**
     * @return Neo[]
     */
    public function getHazardous(): array;
    /**
     * @param bool $isHazardous
     * @return Neo|null
     */
    public function getFastest(bool $isHazardous): ?Neo;
    /**
     * @param bool $isHazardous
     * @return int|null
     */
    public function getBestYear(bool $isHazardous): ?int;
    /**
     * @param bool $isHazardous
     * @return int|null
     */
    public function getBestMonth(bool $isHazardous): ?int;
}
