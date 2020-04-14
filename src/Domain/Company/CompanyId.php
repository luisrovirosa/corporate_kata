<?php

namespace Katas\Domain\Company;

class CompanyId
{
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }
}
