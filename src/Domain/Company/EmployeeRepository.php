<?php

declare(strict_types = 1);

namespace Katas\Domain\Company;

interface EmployeeRepository
{
    public function save(Employee $employee): void;

    /**
     * @throws EmployeeNotFoundException
     */
    public function findById(EmployeeId $id): Employee;
}
