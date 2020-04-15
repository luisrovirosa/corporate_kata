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
    private HotelRepository $hotelRepository;
    private EmployeeRepository $employeeRepository;
    private BookingRepository $bookingRepository;
    private HotelService $hotelService;
    private CompanyService $companyService;
    private BookingService $bookingService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->hotelRepository = new InMemoryHotelRepository();
        $this->hotelService = new HotelService($this->hotelRepository);
        $this->employeeRepository = new InMemoryEmployeeRepository();
        $this->companyService = new CompanyService($this->employeeRepository);
        $this->bookingRepository = new InMemoryBookingRepository();
        $this->bookingService = new BookingService($this->hotelRepository, $this->employeeRepository, $this->bookingRepository);
    }

    /**
     * @test
     */
    public function an_employee_can_book_a_room(): void
    {
        $aHotelId = new HotelId();
        $this->hotelService->addHotel($aHotelId, 'any HotelName');
        $this->hotelService->setRoom($aHotelId, self::NUMBER_OF_ROOMS, RoomType::STANDARD);
        $anEmployeeId = new EmployeeId();
        $this->companyService->addEmployee(new CompanyId(), $anEmployeeId);

        $booking = $this->bookingService->book(
            $anEmployeeId,
            $aHotelId,
            RoomType::STANDARD,
            new DateTimeImmutable(),
            new DateTimeImmutable('+1 day'),
            );

        $retrievedBooking = $this->bookingService->findByBookingId($booking->id());
        $this->assertEquals($booking, $retrievedBooking);
    }

    /**
     * @test
     */
    public function is_not_possible_to_book_when_check_out_date_is_earlier_than_check_in_date(): void
    {
        $aHotelId = new HotelId();
        $this->hotelService->addHotel($aHotelId, 'any HotelName');
        $this->hotelService->setRoom($aHotelId, self::NUMBER_OF_ROOMS, RoomType::STANDARD);
        $anEmployeeId = new EmployeeId();
        $this->companyService->addEmployee(new CompanyId(), $anEmployeeId);

        $this->expectException(InvalidDateRangeException::class);

        $this->bookingService->book(
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
        $this->hotelService->addHotel($aHotelId, 'any HotelName');
        $this->hotelService->setRoom($aHotelId, self::NUMBER_OF_ROOMS, RoomType::STANDARD);
        $anEmployeeId = new EmployeeId();
        $this->companyService->addEmployee(new CompanyId(), $anEmployeeId);

        $this->expectException(InvalidDateRangeException::class);

        $today = $this->today();
        $this->bookingService->book(
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
        $this->hotelService->addHotel($aHotelId, 'any HotelName');
        $this->hotelService->setRoom($aHotelId, self::NUMBER_OF_ROOMS, RoomType::STANDARD);
        $anEmployeeId = new EmployeeId();
        $this->companyService->addEmployee(new CompanyId(), $anEmployeeId);

        $this->expectException(RoomTypeDoesNotExistException::class);

        $this->bookingService->book(
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
