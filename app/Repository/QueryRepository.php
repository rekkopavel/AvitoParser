<?php

namespace App\Repository;

use App\Models\Query;

class QueryRepository
{
    public function findAllQueries():array
    {
        return Query::all()->toArray();
    }

}
