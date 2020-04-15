<?php

declare(strict_types = 1);

namespace Katas\Domain\Booking;

use DateTimeImmutable;
use Katas\Domain\Company\EmployeeId;
use Katas\Domain\Company\EmployeeRepository;
use Katas\Domain\Hotel\HotelId;
use Katas\Domain\Hotel\HotelRepository;
use Katas\Tests\InvalidDateRangeException;

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
        $this->validateDateRange($checkIn, $checkOut);

        $booking = new Booking();
        $this->bookingRepository->save($booking);

        return $booking;
    }

    public function findByBookingId(BookingId $id): Booking
    {
        return $this->bookingRepository->findById($id);
    }

    private function validateDateRange(DateTimeImmutable $checkIn, DateTimeImmutable $checkOut): void
    {
        if ($checkIn > $checkOut){
            throw new InvalidDateRangeException();
        }
    }
}
