<?php

use Tests\Models\User;
use Heseya\Searchable\Searches\Equals;
use Illuminate\Database\Eloquent\Builder;

test('asserts query create', function () {
    $query = User::query();
    $search = new Equals('key', 'value');
    $query = $search->query($query);

    assertInstanceOf(Builder::class, $query);
    assertEquals('select * from "users" where "key" = ?', $query->toSql());
});