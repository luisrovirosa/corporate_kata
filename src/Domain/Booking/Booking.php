<?php

declare(strict_types = 1);

namespace Katas\Domain\Booking;

class Booking
{
    private BookingId $bookingId;
    private BookingDates $dateRange;

    public function __construct(BookingDates $dateRange)
    {
        $this->dateRange = $dateRange;
        $this->bookingId = new BookingId();
    }

    public function id(): BookingId
    {
        return $this->bookingId;
    }

}
