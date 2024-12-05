<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Illuminate\Support\Stringable;
use Spatie\Html\Elements\A;
use stdClass;

class LinkElementMixin extends stdClass
{
    public function link(): mixed
    {
        return function (string $route, mixed $parameters = [], ?string $modifiers = null) {
            /** @var A $this */
            $href = route($route, $parameters);

            $current = str('wire:current')
                ->when($modifiers, fn (Stringable $str) => $str->append(".{$modifiers}"))
                ->squish();

            return $this
                ->attribute('wire:navigate')
                ->attribute($current->value(), 'link-active')
                ->class('link')
                ->href($href);
        };
    }

    public function navigate(): mixed
    {
        return function () {
            /** @var A $this */
            return $this->attribute('wire:navigate');
        };
    }
}
