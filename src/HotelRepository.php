<?php

namespace Katas;

interface HotelRepository
{
    public function findById(HotelId $aHotelId): Hotel;
}
