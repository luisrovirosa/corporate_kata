<?php

declare(strict_types = 1);

namespace Katas\Domain\Booking;

class Booking
{
    private BookingId $bookingId;
    private DateRange $dateRange;

    public function __construct(DateRange $dateRange)
    {
        $this->dateRange = $dateRange;
        $this->bookingId = new BookingId();
    }

    public function id(): BookingId
    {
        return $this->bookingId;
    }

}
