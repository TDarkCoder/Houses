<?php

namespace App\Filters;

use App\Filters\Contract\Filter;

class Garages extends Filter{

    protected function handleFilter($builder){
        return $builder->where('garages', request($this->filteredName()));
    }

}
