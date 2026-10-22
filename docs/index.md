---
title: Introduction
slug: /
---

This package offers a collection of useful [Livewire](https://livewire.laravel.com/) utilities and components.

This is a selection of the available features:

- [Property Synthesizers](./property-synthesizers.md) — Force usage of model route-keys, instead of model ids.
- [Components](./component-extensions.md) — Components like `Page` and useful traits.
- [Forms](./form-extensions.md) — Traits and extensions for [Livewire Forms](https://livewire.laravel.com/docs/forms).
- [State Objects](./state-objects.md) — State objects are based on states that you find, for example, in a VueJS Store.
- [Structure Scout](./structure-scout.md) — Supported by [spatie/php-structure-discoverer](https://github.com/spatie/php-structure-discoverer) package, it provides a scout to discover and register components, which also offers benefits such as caching.
- [Infinite Scroll](./infinite-scroll.md) — Load more results as the user scrolls.
- [HTML](./laravel-html.md) — Extends Spatie's [laravel-html](https://spatie.be/docs/laravel-html/v3/introduction) to generate HTML using a clean, simple and easy to read API.

:::tip

Let your AI agent do the hard parts. This package ships a [Laravel Boost](https://laravel.com/docs/boost) skill, `wireuse-development`, that teaches your agent how to install, configure and use WireUse. Install Boost and select the skill when prompted:

```bash
composer require laravel/boost --dev
php artisan boost:install
```

Already using Boost? Run `php artisan boost:update --discover` to pick up the skill. Then just ask, for example: *"Add an infinite-scrolling tag list with a Load more button."*

:::

Continue to [Installing WireUse](./installing-wireuse.md) to get started.
