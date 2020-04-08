<?php

namespace Katas;

class CompanyId
{
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }
}
