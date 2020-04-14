<?php

namespace Katas\Domain\Company;

class CompanyService
{
    private EmployeeRepository $companyRepository;

    public function __construct(EmployeeRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function addEmployee(CompanyId $companyId, EmployeeId $employeeId)
    {
    }
}
