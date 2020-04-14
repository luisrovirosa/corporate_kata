<?php

namespace Katas\Domain\Booking;

use DateTimeImmutable;
use Katas\Domain\Company\EmployeeId;
use Katas\Domain\Company\EmployeeRepository;
use Katas\Domain\Hotel\HotelId;
use Katas\Domain\Hotel\HotelRepository;

class BookingService
{
    private BookingRepository $bookingRepository;

    private EmployeeRepository $employeeRepository;

    private HotelRepository $hotelRepository;

    public function __construct(HotelRepository $hotelRepository, EmployeeRepository $employeeRepository, BookingRepository $bookingRepository)
    {
        $this->hotelRepository = $hotelRepository;
        $this->employeeRepository = $employeeRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function book(EmployeeId $employeeId, HotelId $hotelId, string $roomType, DateTimeImmutable $checkIn, DateTimeImmutable $checkOut): Booking
    {
        return new Booking();
    }

    public function findByBookingId(BookingId $id): Booking
    {
        return new Booking();
    }
}
