<?php

namespace Katas\Domain\Hotel;

use Katas\Domain\Hotel\HotelId;

class Hotel
{
    private HotelId $hotelId;
    private string $hotelName;
    private array $rooms;

    public function __construct(HotelId $hotelId, string $hotelName)
    {
        $this->hotelId = $hotelId;
        $this->hotelName = $hotelName;
        $this->rooms = [];
    }

    public function name(): string
    {
        return $this->hotelName;
    }

    public function id(): HotelId
    {
        return $this->hotelId;
    }

    public function numberOfRoomsOfType(string $roomType): int
    {
        return $this->rooms[$roomType];
    }

    public function setRoomsOfType(string $roomType, int $numOfRooms): void
    {
        $this->rooms[$roomType] = $numOfRooms;
    }

}
