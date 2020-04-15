<?php

namespace App\Filters;

use App\Filters\Contract\Filter;

class Name extends Filter{

    protected function handleFilter($builder){
        return $builder->where('name', 'LIKE', '%'.request($this->filteredName()).'%');
    }

}
