<?php

namespace Katas\Domain\Company;

use Katas\Domain\Company\CompanyId;
use Katas\Domain\Company\EmployeeId;
use Katas\Domain\Company\EmployeeRepository;

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
