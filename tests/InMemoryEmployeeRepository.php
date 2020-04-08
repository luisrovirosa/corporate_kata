<?php

namespace Katas\Tests;

use Katas\EmployeeRepository;

class InMemoryEmployeeRepository implements EmployeeRepository
{
    public function __construct()
    {
    }
}
