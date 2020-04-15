<?php

declare(strict_types = 1);

namespace Katas\Domain\Hotel;

class Hotel
{
    private HotelId $hotelId;
    private string $hotelName;
    private array $roomTypeCounters;

    public function __construct(HotelId $hotelId, string $hotelName)
    {
        $this->hotelId = $hotelId;
        $this->hotelName = $hotelName;
        $this->roomTypeCounters = [];
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
        return $this->roomTypeCounters[$roomType];
    }

    public function setRoomsOfType(string $roomType, int $numOfRooms): void
    {
        $this->roomTypeCounters[$roomType] = $numOfRooms;
    }
}
