<?php

namespace Katas\Tests\Infrastructure;

use Katas\Domain\Booking\Booking;
use Katas\Domain\Booking\BookingId;
use Katas\Domain\Booking\BookingRepository;

class InMemoryBookingRepository implements BookingRepository
{
    /** @var Booking[] */
    private array $bookings = [];

    public function __construct()
    {
    }

    public function save(Booking $booking): void
    {
        $this->bookings[] = $booking;
    }

    public function findById(BookingId $id): ?Booking
    {
        return array_filter($this->bookings, fn(Booking $booking) => $booking->id() === $id)[0];
    }
}
