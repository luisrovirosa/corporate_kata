<?php

namespace Katas;

class Booking
{
    private BookingId $bookingId;

    public function __construct()
    {
        $this->bookingId = new BookingId();
    }

    public function id(): BookingId
    {
        return $this->bookingId;
    }
}
