<?php

declare(strict_types=1);

namespace Katas\Tests\Domain\Company;


use Katas\Domain\Company\CompanyId;
use Katas\Domain\Company\CompanyService;
use Katas\Domain\Company\Employee;
use Katas\Domain\Company\EmployeeId;
use Katas\Tests\Infrastructure\InMemoryEmployeeRepository;
use PHPUnit\Framework\TestCase;

class CompanyServiceTest extends TestCase
{
    /** @test */
    public function add_employee(): void
    {
        $employeeRepository = new InMemoryEmployeeRepository();
        $companyService = new CompanyService($employeeRepository);
        $aCompanyId = new CompanyId();
        $anEmployeeId = new EmployeeId();

        $companyService->addEmployee($aCompanyId, $anEmployeeId);

        $foundEmployee = $employeeRepository->findById($anEmployeeId);
        $this->assertEquals($aCompanyId, $foundEmployee->companyId());
    }
}
