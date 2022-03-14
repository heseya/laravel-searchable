<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Eloquent\Builder;
use Tests\Models\User;

beforeEach(function () {
    $capsule = new Manager;

    $capsule->addConnection([
        'driver' => 'sqlite',
        'host' => ':memory:',
        'database' => 'database',
    ]);

    $capsule->bootEloquent();
});

test('can search', function () {
    $query = User::searchByCriteria();

    expect($query)->toBeInstanceOf(Builder::class);
    expect($query->toSql())->toBe('select * from "users"');
});

test('can search with additional query', function () {
    $query = User::searchByCriteria()->where('public', true);

    expect($query)->toBeInstanceOf(Builder::class);
    expect($query->toSql())->toBe('select * from "users" where "public" = ?');
});

test('can`t search not searchable param', function () {
    $query = User::searchByCriteria([
        'not_searchable_param' => 'test',
    ]);

    expect($query)->toBeInstanceOf(Builder::class);
    expect($query->toSql())->toBe('select * from "users"');
});

test('can search by default type', function () {
    $query = User::searchByCriteria([
        'email' => 'test@example.com',
    ]);

    expect($query)->toBeInstanceOf(Builder::class);
    expect($query->toSql())->toBe('select * from "users" where "email" = ?');
});

test('can search by custom type', function () {
    $query = User::searchByCriteria([
        'name' => 'test',
    ]);

    expect($query)->toBeInstanceOf(Builder::class);
    expect($query->toSql())->toBe('select * from "users" where "name" LIKE ?');
});
