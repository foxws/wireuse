<?php

use Foxws\WireUse\Support\Html\Mixins\BaseElementMixin;
use Foxws\WireUse\Support\Html\Mixins\HtmlExtendedMixin;
use Foxws\WireUse\Support\Html\Mixins\LinkElementMixin;
use Spatie\Html\BaseElement;
use Spatie\Html\Elements;
use Spatie\Html\Html;

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel HTML
    |--------------------------------------------------------------------------
    |
    | This extends Laravel HTML.
    |
    | @doc https://spatie.be/docs/laravel-html/v3
    |
    */

    'html' => [
        'mixins' => [
            Html::class => HtmlExtendedMixin::class,
            BaseElement::class => BaseElementMixin::class,
            Elements\A::class => LinkElementMixin::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Structure Discovery
    |--------------------------------------------------------------------------
    |
    | This controls structure discovery.
    |
    | @doc https://github.com/spatie/php-structure-discoverer
    |
    */

    'scout' => [
        'cache_store' => null,

        'cache_lifetime' => 60 * 24,
    ],

];
