<?php

namespace App\Filters;

use App\Filters\Contract\Filter;

class Storeys extends Filter{

    protected function handleFilter($builder){
        return $builder->where('storeys', request($this->filteredName()));
    }

}
