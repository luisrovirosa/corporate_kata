<?php

declare(strict_types = 1);

namespace Katas\Tests;

use Katas\Domain\Booking\BookingService;
use Katas\Domain\Company\CompanyId;
use Katas\Domain\Company\CompanyService;
use Katas\Domain\Company\EmployeeId;
use Katas\Domain\Hotel\HotelId;
use Katas\Domain\Hotel\HotelService;
use Katas\Domain\Hotel\RoomType;
use Katas\Tests\Infrastructure\InMemoryBookingRepository;
use Katas\Tests\Infrastructure\InMemoryEmployeeRepository;
use Katas\Tests\Infrastructure\InMemoryHotelRepository;
use PHPUnit\Framework\TestCase;

class BookingServiceTest extends TestCase
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
        $hotelService->addHotel($aHotelId, 'any HotelName');
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
            new \DateTimeImmutable(),
            new \DateTimeImmutable('+1 day'),
            );

        $retrievedBooking = $bookingService->findByBookingId($booking->id());
        $this->assertEquals($booking, $retrievedBooking);
    }
}
