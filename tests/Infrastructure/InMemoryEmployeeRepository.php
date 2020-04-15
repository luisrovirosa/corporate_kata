<?php

declare(strict_types = 1);

namespace Katas\Tests\Infrastructure;

use Katas\Domain\Company\Employee;
use Katas\Domain\Company\EmployeeId;
use Katas\Domain\Company\EmployeeRepository;

class InMemoryEmployeeRepository implements EmployeeRepository
{
    /** @var Employee[] */
    private array $employees = [];

    public function save(Employee $employee): void
    {
        $this->employees[] = $employee;
    }

    public function findById(EmployeeId $id): Employee
    {
        return array_filter($this->employees, fn (Employee $employee) => $employee->id() === $id)[0];
    }
}
