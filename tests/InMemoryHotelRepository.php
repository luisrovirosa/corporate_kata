<?php

namespace Katas\Tests;

use Katas\Hotel;
use Katas\HotelId;
use Katas\HotelRepository;

class InMemoryHotelRepository implements HotelRepository
{
    public function findById(HotelId $aHotelId): Hotel
    {
        return new Hotel();
    }
}
