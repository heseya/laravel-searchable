<?php

use Heseya\Searchable\Criteria\Like;
use Illuminate\Database\Eloquent\Builder;
use Tests\Models\User;

test('asserts query create', function () {
    $query = User::query();
    $search = new Like('key', 'value');
    $query = $search->query($query);

    expect($query)->toBeInstanceOf(Builder::class);
    expect($query->toSql())->toBe('select * from "users" where "key" LIKE ?');
});
