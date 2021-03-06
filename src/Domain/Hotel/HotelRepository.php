<?php

declare(strict_types = 1);

namespace Katas\Domain\Hotel;

interface HotelRepository
{
    /**
     * @throws HotelNotFoundException
     */
    public function findById(HotelId $aHotelId): Hotel;

    public function save(Hotel $hotel): void;
}
