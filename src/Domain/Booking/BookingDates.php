<?php

namespace Katas\Domain\Booking;

use DateTimeImmutable;

class BookingDates
{
    public function __construct(DateTimeImmutable $checkIn, DateTimeImmutable $checkOut)
    {
        $this->validateDateRange($checkIn, $checkOut);

    }
    private function validateDateRange(DateTimeImmutable $checkIn, DateTimeImmutable $checkOut): void
    {
        if ($checkIn > $checkOut){
            throw new InvalidDateRangeException();
        }
    }
}
