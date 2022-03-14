<?php

use Heseya\Searchable\Criteria\Like;
use Illuminate\Database\Eloquent\Builder;
use Tests\Models\User;

test('asserts query create', function () {
    $query = User::query();
    $search = new Like('key', 'value');
    $query = $search->query($query);

    assertInstanceOf(Builder::class, $query);
    assertEquals('select * from "users" where "key" LIKE ?', $query->toSql());
});
