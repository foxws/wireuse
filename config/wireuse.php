<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Livewire Features
    |--------------------------------------------------------------------------
    |
    | This controls Livewire component features.
    |
    | @doc https://foxws.nl/posts/wireuse/property-synthesizers
    |
    */

    'features' => [
        // \Foxws\WireUse\Support\Livewire\StateObjects\SupportStateObjects::class,
        // \Foxws\WireUse\Support\Livewire\ModelStateObjects\SupportModelStateObjects::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel HTML
    |--------------------------------------------------------------------------
    |
    | This extends Laravel HTML.
    |
    | @doc https://foxws.nl/posts/wireuse/laravel-html
    | @doc https://spatie.be/docs/laravel-html/v3
    |
    */

    'html' => [
        'mixins' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Structure Discovery
    |--------------------------------------------------------------------------
    |
    | This controls structure discovery.
    |
    | @doc https://foxws.nl/posts/wireuse/structure-scout
    | @doc https://github.com/spatie/php-structure-discoverer
    |
    */

    'scout' => [
        'enabled' => false,

        'cache_store' => null,

        'cache_lifetime' => 60 * 60 * 24 * 7,
    ],

];
