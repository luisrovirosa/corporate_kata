<?php

namespace Katas\Tests;

use Katas\Hotel;
use Katas\HotelId;
use Katas\HotelRepository;

class InMemoryHotelRepository implements HotelRepository
{
    /** @var Hotel[] */
    private array $hotels;

    public function __construct()
    {
        $this->hotels = [];
    }


    public function findById(HotelId $hotelId): Hotel
    {
        return array_filter($this->hotels, fn(Hotel $hotel) => $hotel->id() === $hotelId)[0];
    }

    public function save(Hotel $hotel): void
    {
        $this->hotels[] = $hotel;
    }
}
