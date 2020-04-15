<?php

declare(strict_types = 1);

namespace Katas\Domain\Company;

class CompanyService
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $companyRepository)
    {
        $this->employeeRepository = $companyRepository;
    }

    public function addEmployee(CompanyId $companyId, EmployeeId $employeeId): void
    {
        $this->employeeRepository->save(new Employee($employeeId, $companyId));
    }
}
