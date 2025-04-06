<?php

namespace App\Services\Parser\Repositories;

use App\Models\Query;

class queryRepository
{
    public function findAllQueries():array
    {
        return Query::all()->toArray();
    }

}
