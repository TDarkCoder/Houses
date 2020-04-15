<?php

namespace App\Filters;

use App\Filters\Contract\Filter;

class Min extends Filter{

    protected function handleFilter($builder){
        return $builder->where('price', '>', request($this->filteredName()));
    }

}
