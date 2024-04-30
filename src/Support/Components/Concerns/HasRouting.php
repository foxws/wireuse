<?php

namespace Foxws\WireUse\Support\Components\Concerns;

use Illuminate\Support\Facades\Route;

trait HasRouting
{
    public function route(?string $route = null, mixed $parameters = null, bool $absolute = true): static
    {
        $this->route = $route;

        $this->routeParameters = $parameters;

        $this->routeAbsolute = $absolute;

        return $this;
    }

    public function getRoute(): string
    {
        return route(
            $this->getRouteName(),
            $this->getRouteParameters(),
            $this->getRouteAbsolute(),
        );
    }

    public function getRouteName(): ?string
    {
        return $this->value('route');
    }

    public function getRouteParameters(): mixed
    {
        return $this->value('routeParameters', []);
    }

    public function getRouteAbsolute(): bool
    {
        return $this->value('routeAbsolute', true);
    }

    public function isRoute(): bool
    {
        return Route::has(
            $this->getRouteName()
        );
    }
}
