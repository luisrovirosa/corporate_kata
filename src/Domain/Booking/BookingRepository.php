<?php

namespace Katas\Domain\Booking;

use Katas\Domain\Booking\Booking;
use Katas\Domain\Booking\BookingId;

interface BookingRepository
{
    public function save(Booking $booking): void;
    public function findById(BookingId $id): ?Booking;
}
