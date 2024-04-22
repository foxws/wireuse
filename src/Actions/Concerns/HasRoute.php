<?php

namespace Foxws\WireUse\Actions\Concerns;

use Illuminate\Support\Facades\Route;

trait HasRoute
{
    public function route(string $route, mixed $parameters = null, bool $absolute = true): static
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

    public function isRoute(): bool
    {
        return $this->hasRoute() && request()->routeIs($this->getRouteName());
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

    public function hasRoute(): bool
    {
        return ($name = $this->getRouteName()) && Route::has($name);
    }
}
