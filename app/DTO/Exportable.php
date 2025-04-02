<?php

declare(strict_types=1);

namespace App\DTO;

trait Exportable
{
    public function toArray(): array
    {
        return array_filter(get_object_vars($this), fn($value) => $value !== null);
    }
}
