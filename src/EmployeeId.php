<?php

namespace Katas;

class EmployeeId
{
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }
}
