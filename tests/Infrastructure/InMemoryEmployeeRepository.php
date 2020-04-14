<?php

namespace Katas\Tests\Infrastructure;

use Katas\Domain\Company\EmployeeRepository;

class InMemoryEmployeeRepository implements EmployeeRepository
{
    public function __construct()
    {
    }
}
