---
title: Laravel HTML (Spatie)
order: 7
tags:
  - html
  - blade
  - views
---

## Introduction

The [laravel-html](https://spatie.be/docs/laravel-html/v3/introduction) package of Spatie helps you generate HTML using a simple and readable API.

WireUse offers mixins to make the package compatible and usable with Livewire.

## Configuration

HTML-mixins are disabled by default, and can be enabled in `config/wireuse.php`:

```bash
php artisan vendor:publish --tag="wireuse-config"
```

```php
'html' => [
    'mixins' => true,
],
```

## Usage

The following example shows how to use the `wireKey` helper to generate a list of posts, e.g. `posts.blade.php`:

```blade
{{ html()->div()->class('grid grid-cols-1 gap-3')->open() }}
    @foreach ($this->posts as $post)
        {{ html()->div()->wireKey($post->getRouteKey())->open() }}
            <livewire:app::post-item :$post :key="$post->getRouteKey()" />
        {{ html()->div()->close() }}
    @endforeach
{{ html()->div()->close() }}
```

The following example shows how to use the `wireForm` helper to generate a form, e.g. `edit.blade.php`:

```blade
{{ html()->wireForm($form, action: 'submit')->class('flex flex-col gap-y-6')->children([
    html()->div()
        ->classIf(flash()->message, 'form-message')
        ->textIf(flash()->message, flash()->message),

    html()->div()->class('form-control')->children([
        html()->label('Name', 'form.name')->class('label'),
        html()->text()->wireModel('form.name')->placeholder('Name')->class('input'),
        html()->validate('form.name'),
    ]),
]) }}
```

To generate a link that includes the `wire:navigate` attribute:

```blade
{{ html()->a()->link('home)->text('Home') }}
```
