<?php

namespace Katas\Tests;

use Katas\HotelId;
use Katas\HotelService;
use PHPUnit\Framework\TestCase;

class HotelServiceTest extends TestCase
{
    /** @test */
    public function add_a_hotel()
    {
        $hotelRepository = new InMemoryHotelRepository();
        $hotelService = new HotelService($hotelRepository);
        $aHotelId = new HotelId();

        $hotelService->addHotel($aHotelId, 'A hotel Name');

        $hotel = $hotelRepository->findById($aHotelId);
        $this->assertEquals('A hotel Name', $hotel->name());
    }
}

