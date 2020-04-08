<?php

namespace Katas;

class HotelService
{
    private HotelRepository $hotelRepository;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function addHotel(HotelId $anyHotelId, string $string)
    {
    }
}
