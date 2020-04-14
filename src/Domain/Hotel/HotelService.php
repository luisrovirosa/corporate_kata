<?php

namespace Katas\Domain\Hotel;

use Katas\Domain\Hotel\Hotel;
use Katas\Domain\Hotel\HotelId;
use Katas\Domain\Hotel\HotelRepository;

class HotelService
{
    private HotelRepository $hotelRepository;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function addHotel(HotelId $hotelId, string $hotelName)
    {
        $this->hotelRepository->save(new Hotel($hotelId, $hotelName));
    }

    public function findHotelBy(HotelId $hotelId): ?Hotel
    {
        return $this->hotelRepository->findById($hotelId);
    }

    public function setRoom(HotelId $hotelId, int $numOfRooms, string $roomType): void
    {
        $hotel = $this->findHotelBy($hotelId);
        $hotel->setRoomsOfType($roomType, $numOfRooms);
    }
}
