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
    $query = User::search();

    assertInstanceOf(Builder::class, $query);
    assertEquals('select * from "users"', $query->toSql());
});

test('can search with additional query', function () {
    $query = User::search()->where('public', true);

    assertInstanceOf(Builder::class, $query);
    assertEquals('select * from "users" where "public" = ?', $query->toSql());
});

test('can`t search not searchable param', function () {
    $query = User::search([
        'not_searchable_param' => 'test',
    ]);

    assertInstanceOf(Builder::class, $query);
    assertEquals('select * from "users"', $query->toSql());
});

test('can search by default type', function () {
    $query = User::search([
        'email' => 'test@example.com',
    ]);

    assertInstanceOf(Builder::class, $query);
    assertEquals('select * from "users" where "email" = ?', $query->toSql());
});

test('can search by custom type', function () {
    $query = User::search([
        'name' => 'test',
    ]);

    assertInstanceOf(Builder::class, $query);
    assertEquals('select * from "users" where "name" LIKE ?', $query->toSql());
});
