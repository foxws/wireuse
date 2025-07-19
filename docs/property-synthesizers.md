---
title: Property Synthesizers
order: 1
tags:
  - eloquent
  - collection
---

## Introduction

> See the following [GitHub Discussion](https://github.com/livewire/livewire/discussions/2627) for more details.

By default the dehydrated value of model properties sent over Livewire might look something like this:

```json
{
    "type": "model",
    "class": "user",
    "key": 1,
    "relationships": []
}
```

When using our property synthesizers it tries to hide the model IDs, by forcing the model [route-key](https://laravel.com/docs/11.x/routing#customizing-the-key) instead of the actual model `key`:

```json
{
    "type": "model",
    "class": "user",
    "key": "91e0df48-a06e-4376-b273-73d97de96352", // notice the UUID
    "relationships": []
}
```

## Usage

To use the property synthesizers, create a custom [Service Provider](https://laravel.com/docs/11.x/providers#writing-service-providers):

```bash
php artisan make:provider LivewireServiceProvider
```

Adjust the `boot` method:

```php
use Foxws\WireUse\Support\Livewire\LegacyModels\EloquentCollectionSynth;
use Foxws\WireUse\Support\Livewire\LegacyModels\EloquentModelSynth;
use Foxws\WireUse\Support\Livewire\Models\CollectionSynth;
use Foxws\WireUse\Support\Livewire\Models\ModelSynth;
use Illuminate\Support\ServiceProvider;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureSynthesizers();
    }

    protected function configureSynthesizers(): void
    {
        app('livewire')->propertySynthesizer([
            ModelSynth::class,
            CollectionSynth::class,
            EloquentModelSynth::class,
            EloquentCollectionSynth::class,
        ]);
    }
}
```

> Warning: This will replace parts of the Livewire model binding property synthesizers. Be careful and test the adjustments!

If you need to use model keys in your views, arrays and collections, it is recommended to use `$model->getRouteKey()` instead of `$model->getKey()` or `$model->id`.

Using [Enforcing Morph Maps](https://livewire.laravel.com/docs/properties#properties-expose-system-information-to-the-browser) may also be useful to not expose the original class and it's namespace.

> Tip: Using a route-key is also useful on child components that need a `wire:key` or `key`.
