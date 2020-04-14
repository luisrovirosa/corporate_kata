<?php

namespace Katas\Tests;

use DateTimeImmutable;
use Katas\BookingService;
use Katas\CompanyId;
use Katas\CompanyService;
use Katas\EmployeeId;
use Katas\HotelId;
use Katas\HotelService;
use Katas\RoomType;
use PHPUnit\Framework\TestCase;

class AcceptanceTest extends TestCase
{
    private const NUMBER_OF_ROOMS = 10;

    /**
     * @test
     */
    public function an_employee_can_book_a_room()
    {
        $aHotelId = new HotelId();
        $hotelRepository = new InMemoryHotelRepository();
        $hotelService = new HotelService($hotelRepository);
        $hotelService->addHotel($aHotelId, "any HotelName");
        $hotelService->setRoom($aHotelId, self::NUMBER_OF_ROOMS, RoomType::STANDARD);
        $anEmployeeId = new EmployeeId();
        $employeeRepository = new InMemoryEmployeeRepository();
        $companyService = new CompanyService($employeeRepository);
        $companyService->addEmployee(new CompanyId(), $anEmployeeId);
        $bookingRepository = new InMemoryBookingRepository();
        $bookingService = new BookingService($hotelRepository, $employeeRepository, $bookingRepository);

        $booking = $bookingService->book(
            $anEmployeeId,
            $aHotelId,
            RoomType::STANDARD,
            new DateTimeImmutable(),
            new DateTimeImmutable('+1 day'),
            );

        $this->markTestIncomplete("Not done yet");
        $retrievedBooking = $bookingService->findByBookingId($booking->id());
        $this->assertEquals($booking, $retrievedBooking);
    }
}
