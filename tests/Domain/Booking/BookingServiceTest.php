<?php

declare(strict_types = 1);

namespace Katas\Tests\Domain\Booking;

use DateTimeImmutable;
use Katas\Domain\Booking\BookingRepository;
use Katas\Domain\Booking\BookingService;
use Katas\Domain\Booking\InvalidDateRangeException;
use Katas\Domain\Company\CompanyId;
use Katas\Domain\Company\CompanyService;
use Katas\Domain\Company\EmployeeId;
use Katas\Domain\Company\EmployeeRepository;
use Katas\Domain\Hotel\HotelId;
use Katas\Domain\Hotel\HotelRepository;
use Katas\Domain\Hotel\HotelService;
use Katas\Domain\Hotel\RoomType;
use Katas\Domain\Hotel\RoomTypeDoesNotExistException;
use Katas\Tests\Infrastructure\InMemoryBookingRepository;
use Katas\Tests\Infrastructure\InMemoryEmployeeRepository;
use Katas\Tests\Infrastructure\InMemoryHotelRepository;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class BookingServiceTest extends TestCase
{
    use ProphecyTrait;

    private const NUMBER_OF_ROOMS = 10;

    /**
     * @test
     */
    public function an_employee_can_book_a_room(): void
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
            new DateTimeImmutable(),
            new DateTimeImmutable('+1 day'),
            );

        $retrievedBooking = $bookingService->findByBookingId($booking->id());
        $this->assertEquals($booking, $retrievedBooking);
    }

    /**
     * @test
     */
    public function is_not_possible_to_book_when_check_out_date_is_earlier_than_check_in_date(): void
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

        $this->expectException(InvalidDateRangeException::class);

        $bookingService->book(
            $anEmployeeId,
            $aHotelId,
            RoomType::STANDARD,
            $this->tomorrow(),
            $this->today(),
            );
    }

    /**
     * @test
     */
    public function is_not_possible_to_book_when_check_out_date_is_the_same_than_check_in_date(): void
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

        $this->expectException(InvalidDateRangeException::class);

        $today = $this->today();
        $bookingService->book(
            $anEmployeeId,
            $aHotelId,
            RoomType::STANDARD,
            $today,
            $today,
        );
    }

    /**
     * no se puede reservar si no existe el tipo de habitación en ese hotel
     * @test
     */
    public function is_not_possible_to_book_when_room_type_is_not_available(): void
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

        $this->expectException(RoomTypeDoesNotExistException::class);

        $bookingService->book(
            $anEmployeeId,
            $aHotelId,
            RoomType::JUNIOR_SUITE,
            $this->today(),
            $this->tomorrow(),
        );
    }

    // se puede reservar la misma habitación para días diferentes
    // se puede reservar más de una vez para el mismo día si hay más de una habitación
    // no se puede reservar si no hay habitaciones disponibles para un día en concreto

    // no puedes reservar si no perteneces a la compañía

    // no se puede comprar si hay políticas de empresa que lo prohiban


    protected function tomorrow(): DateTimeImmutable
    {
        return new DateTimeImmutable('+1 day');
    }

    protected function today(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }
}
