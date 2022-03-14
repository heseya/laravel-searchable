<?php

namespace Tests\Models;

use Heseya\Searchable\Criteria\Like;
use Heseya\Searchable\Traits\HasCriteria;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasCriteria;

    protected $criteria = [
        'email',
        'name' => Like::class,
    ];
}
