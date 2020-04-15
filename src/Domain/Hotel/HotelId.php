<?php

declare(strict_types = 1);

namespace Katas\Domain\Hotel;

class HotelId
{
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }
}
