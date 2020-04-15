<?php

declare(strict_types = 1);

namespace Katas\Tests\Domain\Hotel;

use Katas\Domain\Hotel\Hotel;
use Katas\Domain\Hotel\HotelId;
use Katas\Domain\Hotel\HotelRepository;
use Katas\Domain\Hotel\HotelService;
use Katas\Domain\Hotel\RoomType;
use Katas\Tests\Infrastructure\InMemoryHotelRepository;
use PHPUnit\Framework\TestCase;

class HotelServiceTest extends TestCase
{
    const A_HOTEL_NAME = 'A hotel Name';

    private HotelRepository $hotelRepository;

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

    /** @test */
    public function set_a_room()
    {
        $aHotelId = new HotelId();
        $existingHotel = new Hotel($aHotelId, self::A_HOTEL_NAME);
        $this->hotelRepository->save($existingHotel);
        $hotelService = new HotelService($this->hotelRepository);
        $numberOfRooms = 55;

        $hotelService->setRoom($aHotelId, $numberOfRooms, RoomType::STANDARD);

        $foundHotel = $this->hotelRepository->findById($aHotelId);
        $this->assertEquals($numberOfRooms, $foundHotel->numberOfRoomsOfType(RoomType::STANDARD));
    }
}
