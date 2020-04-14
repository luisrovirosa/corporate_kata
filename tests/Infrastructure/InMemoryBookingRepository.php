<?php

namespace Katas\Tests\Infrastructure;

use Katas\Domain\Booking\BookingRepository;

class InMemoryBookingRepository implements BookingRepository
{
    public function __construct()
    {
    }
}
