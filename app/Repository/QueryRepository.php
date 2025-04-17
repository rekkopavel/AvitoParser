<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Query;
use App\Exceptions\EmptyQueriesException;

readonly class QueryRepository
{
    public function __construct(
        private readonly Query $queryModel
    )
    {
    }


    public function findActiveQueries(): array
    {
        $queries = $this->queryModel::where('active', true)->get()->toArray();

        if ($queries === []) {
            throw new EmptyQueriesException();
        }
        return $queries;
    }

}
