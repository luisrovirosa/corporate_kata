<?php

namespace Katas\Domain\Hotel;

interface HotelRepository
{
    public function findById(HotelId $aHotelId): Hotel;

	public function save(Hotel $hotel): void;
}
