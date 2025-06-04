<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Livewire Features
    |--------------------------------------------------------------------------
    |
    | This allows to enable/disable additional Livewire features.
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
    | This extends Laravel HTML for usage with Livewire.
    |
    | @doc https://foxws.nl/posts/wireuse-laravel-html-spatie
    | @doc https://spatie.be/docs/laravel-html/v3
    |
    */

    'html' => [
        'mixins' => env('WIREUSE_MIXINS_ENABLED', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Structure Discovery
    |--------------------------------------------------------------------------
    |
    | This controls structure auto-discovery.
    | To enable caching, set cache_store to null or any defined cache store.
    |
    | @doc https://foxws.nl/posts/wireuse-structure-scout
    | @doc https://github.com/spatie/php-structure-discoverer
    |
    */

    'scout' => [
        'enabled' => env('WIREUSE_SCOUT_ENABLED', false),

        'cache_store' => env('WIREUSE_CACHE_STORE', false),

        'cache_lifetime' => (int) env('WIREUSE_CACHE_LIFETIME', 60 * 60 * 24 * 7),
    ],

    /*
    |--------------------------------------------------------------------------
    | SEO
    |--------------------------------------------------------------------------
    |
    | This allows usage of the WithSeo concern.
    |
    | @doc https://github.com/artesaos/seotools
    |
    */

    'seo' => [
        'enabled' => env('WIREUSE_SEO_ENABLED', false),
    ],

];
