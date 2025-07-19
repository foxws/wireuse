---
title: Structure Scout
order: 4
tags:
  - livewire
  - components
  - strucutures
---

## Introduction

If you have a lot of Blade or Livewire components, it may take a lot of work to register them manually, especially in multi-tenancy applications.

The component scout can help with this. It is supported by [spatie/php-structure-discoverer](https://github.com/spatie/php-structure-discoverer) package, which also offers benefits such as caching.

It is recommend to use a domain-driven-design (DDD) pattern, such as `src/App/Posts/Components/Card.php`. Spatie offers an excellent in [dept course](https://spatie.be/products/laravel-beyond-crud) about DDD.

## Configuration

Structure Scout is disabled by default, and can be enabled in `config/wireuse.php`:

```bash
php artisan vendor:publish --tag="wireuse-config"
```

```php
'scout' => [
    'enabled' => true,

    'cache_store' => null,

    'cache_lifetime' => 60 * 60 * 24 * 7,
],
```

## Blade Components

To auto-discover Blade components, create and register a [service provider](https://laravel.com/docs/11.x/providers):

```bash
php artisan make:provider ViewServiceProvider
```

```php
use Foxws\WireUse\Scout\ComponentScout;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerComponents();
    }

    protected function registerComponents(): static
    {
        ComponentScout::create(app_path('Web'), 'App\\')->register();

        return $this;
    }
}
```

To call a registered Blade component:

```php
<x-web.posts.card :$item />
```

### Livewire Components

To discover Livewire components, create and register a [service provider](https://laravel.com/docs/11.x/providers):

```bash
php artisan make:provider LivewireServiceProvider
```

```php
use Foxws\WireUse\Scout\LivewireScout;
use Illuminate\Support\ServiceProvider;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerComponents();
    }

    protected function registerComponents(): static
    {
        LivewireScout::create(app_path('Web'), 'App\\')->register();

        return $this;
    }
}
```

To call a registered Livewire component:

```php
<livewire:web.posts.tags />
```
