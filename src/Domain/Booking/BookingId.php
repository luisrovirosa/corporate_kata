<?php

namespace Katas\Domain\Booking;

class BookingId
{
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }
}