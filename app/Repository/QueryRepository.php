<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Query;

class QueryRepository
{
    public function findAllActiveQueries(): array
    {
        $output = Query::where('active', true)->get()->toArray();

        if ($output === []) {
            throw new \Exception('Table queries is empty');
        }
        return $output;
    }

}
