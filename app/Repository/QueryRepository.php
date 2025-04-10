<?php

namespace App\Repository;

use App\Models\Query;

class QueryRepository
{
    public function findAllActiveQueries():array
    {
        return Query::where('active', true)->get()->toArray();
    }

}
