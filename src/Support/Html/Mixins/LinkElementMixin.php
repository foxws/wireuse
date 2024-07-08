<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Spatie\Html\Elements\A;

class LinkElementMixin
{
    public function route(): mixed
    {
        return function (string $route, ...$parameters) {
            /** @var A $this */
            $href = route($route, ...$parameters);

            return $this
                ->navigate()
                ->href($href)
                ->class([
                    'link',
                    'link-active' => request()->routeIs($route, "{$route}.*") || request()->fullUrlIs($href),
                ]);
        };
    }
}
