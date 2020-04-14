<?php

namespace Katas\Domain\Company;

class EmployeeId
{
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }
}
