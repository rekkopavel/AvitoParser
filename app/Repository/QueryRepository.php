<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exceptions\EmptyQueriesException;
use App\Models\Query;

readonly class QueryRepository
{
    public function __construct(
        private Query $queryModel
    ) {}

    public function findActiveQueries(): array
    {
        $queries = $this->queryModel->newQuery()
            ->active()
            ->get()
            ->toArray();

        if ($queries === []) {
            throw new EmptyQueriesException;
        }

        return $queries;
    }
}
