<?php

namespace Katas;

class HotelId
{
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }
}
