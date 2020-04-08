<?php

namespace Katas\Tests;

use Katas\Hotel;
use Katas\HotelId;
use Katas\HotelService;
use PHPUnit\Framework\TestCase;

class HotelServiceTest extends TestCase
{
    const A_HOTEL_NAME = 'A hotel Name';

    /** @test */
    public function add_a_hotel()
    {
        $hotelRepository = new InMemoryHotelRepository();
        $hotelService = new HotelService($hotelRepository);
        $aHotelId = new HotelId();

        $hotelService->addHotel($aHotelId, self::A_HOTEL_NAME);

        $hotel = $hotelRepository->findById($aHotelId);
        $this->assertEquals(self::A_HOTEL_NAME, $hotel->name());
    }

    /** @test */
    public function find_an_existing_hotel()
    {
        $hotelRepository = new InMemoryHotelRepository();
        $aHotelId = new HotelId();
        $existingHotel = new Hotel($aHotelId, self::A_HOTEL_NAME);
        $hotelRepository->save($existingHotel);
        $hotelService = new HotelService($hotelRepository);

        $foundHotel = $hotelService->findHotelBy($aHotelId);

        $this->assertEquals($existingHotel, $foundHotel);
    }
}

