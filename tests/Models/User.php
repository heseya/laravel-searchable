<?php

namespace Tests\Models;

use Heseya\Searchable\Searches\Like;
use Heseya\Searchable\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Searchable;

    protected $searchable = [
        'email',
        'name' => Like::class,
    ];
}
