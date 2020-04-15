<?php

declare(strict_types = 1);

namespace Katas\Domain\Company;

class CompanyId
{
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }
}
