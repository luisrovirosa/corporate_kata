<?php

declare(strict_types = 1);

namespace Katas\Domain\Booking;

use DateTimeImmutable;

class Booking
{
    private BookingId $bookingId;

    public function __construct(DateTimeImmutable $checkIn, DateTimeImmutable $checkOut)
    {
        $this->validateDateRange($checkIn, $checkOut);
        $this->bookingId = new BookingId();
    }

    public function id(): BookingId
    {
        return $this->bookingId;
    }

    private function validateDateRange(DateTimeImmutable $checkIn, DateTimeImmutable $checkOut): void
    {
        if ($checkIn > $checkOut){
            throw new InvalidDateRangeException();
        }
    }

}
