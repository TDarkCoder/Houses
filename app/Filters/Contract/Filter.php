<?php

namespace App\Filters\Contract;

use Closure;
use Illuminate\Support\Str;

abstract class Filter{

    public function handle($request, Closure $next){

        if(!request()->has($this->filteredName())){
            return $next($request);
        }

        $builder = $next($request);
        return $this->handleFilter($builder);

    }

    protected function filteredName(){
        return Str::snake(class_basename($this));
    }

    protected abstract function handleFilter($builder);

}
