<?php

use Foxws\WireUse\Support\Html\Mixins\BaseElementMixin;
use Foxws\WireUse\Support\Html\Mixins\HtmlExtendedMixin;
use Foxws\WireUse\Support\Html\Mixins\ImgElementMixin;
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
    | This controls Laravel HTML.
    |
    | @doc https://spatie.be/docs/laravel-html/v3
    |
    */

    'html' => [
        'mixins' => [
            Html::class => HtmlExtendedMixin::class,
            BaseElement::class => BaseElementMixin::class,
            Elements\A::class => LinkElementMixin::class,
            Elements\Img::class => ImgElementMixin::class,
        ],
    ],

];
