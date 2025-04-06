<?php

namespace App\Services\Parser\Repositories;

use App\Models\Query;

class QueryRepository
{
    public function findAllQueries():array
    {
        return Query::all()->toArray();
    }

}
