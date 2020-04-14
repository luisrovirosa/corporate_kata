<?php

namespace Katas\Tests\Infrastructure;

use Katas\Domain\Company\Employee;
use Katas\Domain\Company\EmployeeId;
use Katas\Domain\Company\EmployeeRepository;

class InMemoryEmployeeRepository implements EmployeeRepository
{
    private array $items = [];

    public function save(Employee $employee)
    {
        $this->items[] = $employee;
    }

    public function findById(EmployeeId $id): ?Employee
    {
        return array_filter($this->items, fn(Employee $employee) => $employee->id() === $id)[0];
    }
}
