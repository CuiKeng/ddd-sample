<?php

declare(strict_types=1);

namespace App\CargoBC\Query;

use App\CargoBC\Query\Dto\CargoDto;

class CargoQuery
{
    public function getCargo(string $uuid): CargoDto
    {
        return new CargoDto('f90e45e5-e9ed-4d91-acb5-3cf4c8a0e54f');
    }
}