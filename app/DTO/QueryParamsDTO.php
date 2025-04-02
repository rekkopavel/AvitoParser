<?php

declare(strict_types=1);

namespace App\DTO;

class QueryParamsDTO
{
    use Exportable;

    public function __construct(
        public ?string $title = '',
        public ?string $city = '',
        public ?string $link = null
    )
    {

    }

    public static function fromConfig(array $query): self
    {

        return new self ($query['title'], $query['city'], $query['uri']);
    }
}
