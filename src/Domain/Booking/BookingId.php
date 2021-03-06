<?php

declare(strict_types = 1);

namespace Katas\Domain\Booking;

class BookingId
{
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }
}
