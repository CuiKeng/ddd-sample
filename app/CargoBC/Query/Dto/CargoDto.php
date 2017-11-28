<?php

declare(strict_types=1);

namespace App\CargoBC\Query\Dto;

use Illuminate\Contracts\Support\Arrayable;

class CargoDto implements Arrayable
{
    /**
     * @var string
     */
    public $uuid;
    
    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }
    
    public function toArray()
    {
        return [
            'uuid' => $this->uuid
        ];
    }
}