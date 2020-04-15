<?php

declare(strict_types = 1);

namespace Katas\Domain\Booking;

use DateTimeImmutable;
use Katas\Domain\Company\EmployeeId;
use Katas\Domain\Company\EmployeeRepository;
use Katas\Domain\Hotel\HotelId;
use Katas\Domain\Hotel\HotelRepository;
use Katas\Domain\Hotel\RoomTypeDoesNotExistException;

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
        $hotel = $this->hotelRepository->findById($hotelId);
        $numberOfRooms = $hotel->numberOfRoomsOfType($roomType);
        if ($numberOfRooms == 0) {
            throw new RoomTypeDoesNotExistException();
        }

        $booking = new Booking(new BookingDates($checkIn, $checkOut));
        $this->bookingRepository->save($booking);

        return $booking;
    }

    public function findByBookingId(BookingId $id): Booking
    {
        return $this->bookingRepository->findById($id);
    }
}
