<?php

namespace Katas\Tests;

use Katas\Hotel;
use Katas\HotelId;
use Katas\HotelService;
use PHPUnit\Framework\TestCase;

class HotelServiceTest extends TestCase
{
    const A_HOTEL_NAME = 'A hotel Name';
    private $hotelRepository;

    protected function setUp(): void
    {
        $this->hotelRepository = new InMemoryHotelRepository();
        parent::setUp();
    }

    /** @test */
    public function add_a_hotel()
    {
        $hotelService = new HotelService($this->hotelRepository);
        $aHotelId = new HotelId();

        $hotelService->addHotel($aHotelId, self::A_HOTEL_NAME);

        $hotel = $this->hotelRepository->findById($aHotelId);
        $this->assertEquals(self::A_HOTEL_NAME, $hotel->name());
    }

    /** @test */
    public function find_an_existing_hotel()
    {
        $aHotelId = new HotelId();
        $existingHotel = new Hotel($aHotelId, self::A_HOTEL_NAME);
        $this->hotelRepository->save($existingHotel);
        $hotelService = new HotelService($this->hotelRepository);

        $foundHotel = $hotelService->findHotelBy($aHotelId);

        $this->assertEquals($existingHotel, $foundHotel);
    }
}

