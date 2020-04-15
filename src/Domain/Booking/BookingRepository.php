<?php

declare(strict_types = 1);

namespace Katas\Domain\Booking;

interface BookingRepository
{
    public function save(Booking $booking): void;

    public function findById(BookingId $id): ?Booking;
}
