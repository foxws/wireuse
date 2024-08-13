<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Spatie\Html\Elements\A;

class LinkElementMixin
{
    public function link(): mixed
    {
        return function (string $route, ...$parameters) {
            /** @var A $this */
            $href = route($route, ...$parameters);

            return $this
                ->attribute('wire:navigate')
                ->href($href)
                ->class([
                    'link',
                    'link-active' => request()->routeIs($route, "{$route}.*") || request()->fullUrlIs($href),
                ]);
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
