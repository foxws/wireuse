---
name: wireuse-development
description: >
  Build Livewire apps with foxws/wireuse, including Page and Component base classes, extended Livewire forms, infinite scroll, state objects, route-key property synthesizers, component discovery and laravel-html mixins.
license: MIT
metadata:
  author: francoism90
---

# WireUse

Use this skill when a Livewire 4 application uses the `foxws/wireuse` package, or works with `Foxws\WireUse` classes such as `Page`, `Component`, `Form`, `WithPaginateScroll`, `State`, `ComponentScout` / `LivewireScout` or `config/wireuse.php`.

## Workflow

### 1. Install

- `composer require foxws/wireuse` (requires `livewire/livewire` ^4.2).
- `php artisan vendor:publish --tag="wireuse-config"` to turn on optional features. Each optional feature also needs its own package:

| Feature | Config | Extra package |
| --- | --- | --- |
| Structure Scout | `scout.enabled` / `WIREUSE_SCOUT_ENABLED` | `spatie/php-structure-discoverer` |
| SEO on `Page` | `seo.enabled` / `WIREUSE_SEO_ENABLED` | `artesaos/seotools` |
| HTML mixins | `html.mixins` / `WIREUSE_MIXINS_ENABLED` | `spatie/laravel-html` |
| State objects | add `SupportStateObjects::class` to `features` | — |

### 2. Pages and components

- `Foxws\WireUse\Views\Support\Page` extends `Livewire\Component` for full-page components. Override `authorizeAccess()` and call `$this->canView($model)`, `canViewAny()`, `canCreate()`, `canUpdate()` or `canDelete()`; with SEO enabled, `getTitle()`, `getDescription()` and `getRobots()` set the meta tags.
- `Foxws\WireUse\Views\Support\Component` extends Blade's `Component` with `WithHash`, `WithLivewire` (`wireKey()`, `wireModel()`), `Conditionable` and `Macroable`.

### 3. Forms

Extend `Foxws\WireUse\Forms\Support\Form` instead of `Livewire\Form`, put the logic in `handle()` and call `$this->form->submit()`. `submit()` rate-limits (when `protected static int $maxAttempts` is above 0), calls `beforeValidate()`, validates, calls `afterValidate()`, stores to the session (when `protected static bool $store` is true), calls `beforeHandle()`, `handle()` and `afterHandle()`. Read input with `$form->get()`, `has()`, `filled()`, `blank()` or `contains()`; inside the form, `$this->collect()`, `$this->fluent()` and `$this->request()` return it as a collection, `Fluent` or `FormRequest`. Set `protected static bool $recoverable = true` to reset dynamic forms on validation errors.

### 4. Infinite scroll

Use `Foxws\WireUse\Models\Concerns\WithPaginateScroll` on a Livewire component, return the model class from `getModelClass()`, and optionally override `getBuilder()` (a `simplePaginate()` of `$this->getQuery()`), `getCandidatesLimit()` (page size) and `getFetchLimits()` (maximum fetches). In the view, loop over `$this->items`, show a "Load more" button calling `nextPage` while `$this->isFetchable()`, or use `x-intersect.full="$wire.nextPage()"`. Add `Livewire\WithoutUrlPagination` to hide `?page=`.

### 5. State objects

Extend `Foxws\WireUse\Support\Livewire\StateObjects\State`, add it as a typed property (`public PostState $state;`), `fill()` it in `mount()`, and read it as `$this->state->...`. Pass it to a child with `<livewire:child :$state />` and `use WithState` there; the parent property must be named `$state`.

### 6. Property synthesizers

Register `ModelSynth`, `CollectionSynth`, `EloquentModelSynth` and `EloquentCollectionSynth` with `app('livewire')->propertySynthesizer([...])` in a service provider's `boot()`, so Livewire payloads carry route keys instead of IDs. Use `$model->getRouteKey()` for `wire:key` and in views.

### 7. Structure Scout

With `scout.enabled`, register discovered components in a service provider's `boot()`:

```php
ComponentScout::create(app_path('Web'), 'App\\')->register(); // <x-web.posts.card />
LivewireScout::create(app_path('Web'), 'App\\')->register();  // <livewire:web.posts.tags />
```

## Rules

- Enable an optional feature only together with its package; otherwise the app aborts with a 500 error at boot.
- Property synthesizers replace parts of Livewire's model binding; test pages that bind models after enabling them.

## References

- [component-extensions.md](https://github.com/foxws/wireuse/blob/main/docs/component-extensions.md)
- [form-extensions.md](https://github.com/foxws/wireuse/blob/main/docs/form-extensions.md)
- [infinite-scroll.md](https://github.com/foxws/wireuse/blob/main/docs/infinite-scroll.md)
- [state-objects.md](https://github.com/foxws/wireuse/blob/main/docs/state-objects.md)
- [property-synthesizers.md](https://github.com/foxws/wireuse/blob/main/docs/property-synthesizers.md)
- [structure-scout.md](https://github.com/foxws/wireuse/blob/main/docs/structure-scout.md)
- [laravel-html.md](https://github.com/foxws/wireuse/blob/main/docs/laravel-html.md)
