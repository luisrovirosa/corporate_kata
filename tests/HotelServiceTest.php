<?php

namespace Katas\Tests;

use Katas\HotelId;
use Katas\HotelService;
use PHPUnit\Framework\TestCase;

class HotelServiceTest extends TestCase
{
    /** @test */
    public function hotel_manager_can_create_an_hotel()
    {
        $this->markTestIncomplete("Not yet");
        $hotelRepository = new InMemoryHotelRepository();
        $hotelService = new HotelService($hotelRepository);
        $aHotelId = new HotelId();

        $hotelService->addHotel($aHotelId, 'A hotel Name');

        $hotel = $hotelRepository->findById($aHotelId);
        $this->assertEquals('A hotel Name', $hotel->name());
    }
}

