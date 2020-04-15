<?php

declare(strict_types = 1);

namespace Katas\Domain\Company;

interface EmployeeRepository
{
    public function save(Employee $employee);

    public function findById(EmployeeId $id): ?Employee;
}
