<?php

namespace Katas;

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

    public function setRoom(HotelId $aHotelId, int $numOfRooms, string $roomType): void
    {
        // do something
    }
}
