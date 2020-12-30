<?php

namespace App\Scopes;
use Request;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Auth;
class OrderCategoryScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {

            $builder->orderBy("updated_at","desc");

        
    }
}
