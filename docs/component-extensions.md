---
title: Extending Components
order: 2
tags:
  - blade
  - controllers
  - livewire
  - views
---

## Introduction

WireUse offers a set of classes and traits that may be included on your [Blade Component](https://laravel.com/docs/11.x/blade#components) and [Livewire Components](https://livewire.laravel.com/docs/components).

> Traits may also be used separately in own components.

## Page Controllers

The `Foxws\WireUse\Views\Support\Page` extends `Livewire\Component`, and can serve as a Livewire controller:

```php
use Foxws\WireUse\Views\Support\Page;

class PostViewController extends Page
{
    public Post $post;

    protected function authorizeAccess(): void
    {
        $this->canView($this->post);
    }

    protected function getTitle(): string
    {
        return (string) $this->post->name;
    }

    protected function getDescription(): string
    {
        return (string) $this->post->summary;
    }
}
```

The `Page` class  and includes the following traits:

- `WithAuthentication` - Can be used to retrieve the current user.
- `WithAuthorization` - Can be used to authorize the current user.
- `WithHash` - Can be used to generate a hash for the given component.
- `WithSeo` - Can be used to generate SEO using [artesaos/seotools](https://github.com/artesaos/seotools).

## Blade Component

The `Foxws\WireUse\Views\Support\Component` class extends `Illuminate\View\Component`, and may be usable for Blade components:

```php
use Foxws\WireUse\Views\Support\Component;
use Illuminate\Contracts\Support\Htmlable;

class Button extends Component
{
    public function __construct(
        public string|Htmlable|null $label = '',
    ) {
    }
}
```

The `Component` class includes the following traits:

- `WithHash` - This may be useful to generate unique hashes based on the class or class properties.
- `WithLivewire` - Offers methods like `wireKey()` and `wireModel()` if a `wire:model` is injected as attribute.
- `Conditionable` - This offers `when` like methods on the component.
- `Macroable` - This allows component overruling and extending by mixins and macros.
