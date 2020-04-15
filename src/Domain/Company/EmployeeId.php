<?php

declare(strict_types = 1);

namespace Katas\Domain\Company;

class EmployeeId
{
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }
}
