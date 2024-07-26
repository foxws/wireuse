<?php

namespace Foxws\WireUse;

use Foxws\WireUse\Support\Discover\ComponentScout;
use Foxws\WireUse\Support\Discover\LivewireScout;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Stringable;
use Livewire\LivewireManager;
use Spatie\StructureDiscoverer\Data\DiscoveredStructure;

class WireUse
{
    public static function registerComponents(
        string $path,
        string $namespace = 'App\\',
        string $prefix = '',
    ): void {
        $scout = ComponentScout::create()
            ->path($path)
            ->prefix("laravel-components-{$prefix}")
            ->get();

        collect($scout)
            ->each(function (DiscoveredStructure $class) use ($namespace, $prefix) {
                $name = static::componentName($class, $namespace, $prefix);

                Blade::component($class->getFcqn(), $name->value());
            });
    }

    public static function registerLivewireComponents(
        string $path,
        string $namespace = 'App\\',
        string $prefix = '',
    ): void {
        $scout = LivewireScout::create()
            ->path($path)
            ->prefix("livewire-components-{$prefix}")
            ->get();

        $manager = app(LivewireManager::class);

        collect($scout)
            ->each(function (DiscoveredStructure $class) use ($manager, $namespace, $prefix) {
                $name = static::componentName($class, $namespace, $prefix);

                $fcqn = $class->getFcqn();

                if ($manager->isDiscoverable($fcqn)) {
                    $manager->component($name->value(), $fcqn);
                }
            });
    }

    public static function componentName(DiscoveredStructure $class, string $namespace, string $prefix): Stringable
    {
        return str($class->name)
            ->kebab()
            ->prepend(
                static::componentPrefix($prefix),
                static::componentNamespace($class, $namespace)
            );
    }

    public static function componentPrefix(string $prefix): Stringable
    {
        return str($prefix)
            ->kebab()
            ->finish('::');
    }

    public static function componentNamespace(DiscoveredStructure $class, string $namespace): Stringable
    {
        return str($class->namespace)
            ->after($namespace)
            ->match('/(.*)\\\\/')
            ->kebab()
            ->finish('-');
    }
}
