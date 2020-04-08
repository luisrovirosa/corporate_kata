<?php

namespace Katas;

class Hotel
{
    private HotelId $hotelId;
    private string $hotelName;

    public function __construct(HotelId $hotelId, string $hotelName)
    {
        $this->hotelId = $hotelId;
        $this->hotelName = $hotelName;
    }


    public function name(): string
    {
        return $this->hotelName;
    }

    public function id(): HotelId
    {
        return $this->hotelId;
    }
}
