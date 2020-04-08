<?php

namespace Katas\Tests;

use Katas\BookingRepository;

class InMemoryBookingRepository implements BookingRepository
{
    public function __construct()
    {
    }
}
