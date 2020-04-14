<?php

namespace Katas\Domain\Hotel;

use Katas\Domain\Hotel\Hotel;
use Katas\Domain\Hotel\HotelId;

interface HotelRepository
{
    public function findById(HotelId $aHotelId): Hotel;

	public function save(Hotel $hotel): void;
}
