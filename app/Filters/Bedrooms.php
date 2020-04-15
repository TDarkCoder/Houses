<?php

namespace App\Filters;

use App\Filters\Contract\Filter;

class Bedrooms extends Filter{

    protected function handleFilter($builder){
        return $builder->where('bedrooms', request($this->filteredName()));
    }

}
