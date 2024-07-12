<?php

namespace Foxws\WireUse\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Foxws\WireUse\WireUse
 *
 * @method static void registerComponents(string $name, string $namespace, string $prefix, ?Closure $callback = null)
 * @method static void registerLivewireComponents(string $name, string $namespace, string $prefix, ?Closure $callback = null)
 * @method static Stringable componentName(DiscoveredClass $class, string $namespace, string $prefix)
 * @method static Stringable componentNamespace(DiscoveredClass $class, string $namespace)
 * @method static string componentPrefix(string $prefix)
 */
class WireUse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Foxws\WireUse\WireUse::class;
    }
}
