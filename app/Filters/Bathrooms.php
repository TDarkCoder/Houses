<?php

namespace App\Filters;

use App\Filters\Contract\Filter;

class Bathrooms extends Filter{

    protected function handleFilter($builder){
        return $builder->where('bathrooms', request($this->filteredName()));
    }

}
