<?php

namespace Katas;

class BookingId
{
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }
}
