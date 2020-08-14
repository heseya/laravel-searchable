<?php

namespace Tests\Models;

use Heseya\Searchable\Searches\Like;
use Illuminate\Database\Eloquent\Model;
use Heseya\Searchable\Traits\Searchable;

class User extends Model
{
    use Searchable;

    protected $searchable = [
        'email',
        'name' => Like::class,
    ];
}
