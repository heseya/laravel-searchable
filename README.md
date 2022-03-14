# Heseya\Searchable

[![Made by Heseya](https://img.shields.io/badge/Made%20by-Heseya-69001f?style=flat-square)](https://heseya.com)
[![StyleCI](https://github.styleci.io/repos/286227561/shield?branch=master)](https://github.styleci.io/repos/286227561)
[![Packagist Version](https://img.shields.io/packagist/v/heseya/laravel-searchable.svg?style=flat-square)](https://packagist.org/packages/heseya/laravel-searchable)
[![Total Downloads](https://img.shields.io/packagist/dt/heseya/laravel-searchable.svg?style=flat-square)](https://packagist.org/packages/heseya/laravel-searchable)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

🔍 Search trait for Eloquent models.

## Installation
```
$ composer require heseya/laravel-searchable
```

## How to use it?
```php
class User extends Model
{
    use HasCriteria;

    protected $criteria = [
        'id', // default search
        'email' => Equals::class,
        'name' => Like::class,
        'description' => Custom::class,
    ];
}
```

```php
class Controller
{
    function index(Request $request)
    {
        User::searchByCriteria([
            'email' => 'example@example.com',
            'name' => 'John'
        ])->get();

        // you can extends query

        User::searchByCriteria($request->all())
            ->where('public', true)
            ->get();
    }
}
```

## Available criteria
- Equals
- Like

## Custom criterion
```php
final class CustomCriterion extends Criterion
{
    public function query(Builder $query): Builder
    {
        // do whatever you want

        return $query;
    }
}

```

## Change default search for model
```php
class User extends Model
{
    protected function getDefaultSearchType(): string
    {
        return Equals::class;
    }
}
```

## Testing
To run the tests, run the following command from the project folder.

```
$ composer test
```

## License
Package released under the MIT License.
See the [LICENSE](https://github.com/heseya/laravel-searchable/blob/master/LICENSE) file for details.
