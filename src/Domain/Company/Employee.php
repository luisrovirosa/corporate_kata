<?php

declare(strict_types=1);

namespace Katas\Domain\Company;


class Employee
{
    private EmployeeId $id;
    private CompanyId $companyId;

    public function __construct(EmployeeId $id, CompanyId $companyId)
    {
        $this->id = $id;
        $this->companyId = $companyId;
    }

    public function id(): EmployeeId
    {
        return $this->id;
    }

    public function companyId(): CompanyId
    {
        return $this->companyId;
    }
}
