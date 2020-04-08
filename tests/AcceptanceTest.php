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
    /**
     * @test
     */
    public function an_employee_can_book_a_room()
    {
        $this->markTestIncomplete("Not done yet");
        $aHotelId = new HotelId();
        $hotelRepository = new InMemoryHotelRepository();
        $hotelService = new HotelService($hotelRepository);
        $hotelService->addHotel($aHotelId, "any HotelName");
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

        $retrievedBooking = $bookingService->findByBookingId($booking->id());
        $this->assertEquals($booking, $retrievedBooking);
    }
}
