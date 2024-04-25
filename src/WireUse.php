<?php

namespace Foxws\WireUse;

use Closure;
use Foxws\WireUse\Auth\Controllers\LoginController;
use Foxws\WireUse\Auth\Controllers\LogoutController;
use Foxws\WireUse\Auth\Controllers\RegisterController;
use Foxws\WireUse\Support\Discover\ComponentScout;
use Foxws\WireUse\Support\Discover\LivewireScout;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Stringable;
use Livewire\Livewire;
use Spatie\StructureDiscoverer\Data\DiscoveredClass;

class WireUse
{
    public static function routes(): void
    {
        Route::get('/login', LoginController::class)->middleware('guest')->name('login');
        Route::get('/register', RegisterController::class)->middleware('guest')->name('register');
        Route::post('/logout', LogoutController::class)->name('logout');
    }

    public static function registerComponents(
        string $path,
        string $namespace = 'App\\',
        string $prefix = '',
        ?Closure $callback = null,
    ): void {
        $scout = ComponentScout::create()
            ->path($path)
            ->prefix("laravel-components-{$prefix}")
            ->get();

        collect($scout)
            ->each(function (DiscoveredClass $class) use ($namespace, $prefix, $callback) {
                $name = $callback instanceof Closure
                    ? $callback($class, $namespace)
                    : static::componentName($class, $namespace, $prefix);

                Blade::component($class->getFcqn(), $name->value());
            });
    }

    public static function registerLivewireComponents(
        string $path,
        string $namespace = 'App\\',
        string $prefix = '',
        ?Closure $callback = null,
    ): void {
        $scout = LivewireScout::create()
            ->path($path)
            ->prefix("livewire-components-{$prefix}")
            ->get();

        collect($scout)
            ->each(function (DiscoveredClass $class) use ($namespace, $prefix, $callback) {
                $name = $callback instanceof Closure
                    ? $callback($class, $namespace)
                    : static::componentName($class, $namespace, $prefix);

                Livewire::component($name->value(), $class->getFcqn());
            });
    }

    public static function componentName(DiscoveredClass $class, string $namespace, string $prefix): Stringable
    {
        return str($class->name)
            ->kebab()
            ->prepend(
                static::componentPrefix($prefix),
                static::componentNamespace($class, $namespace)
            );
    }

    public static function componentPrefix(string $prefix): string
    {
        return str($prefix)
            ->kebab()
            ->finish('::');
    }

    public static function componentNamespace(DiscoveredClass $class, string $namespace): Stringable
    {
        return str($class->namespace)
            ->after($namespace)
            ->match('/(.*)\\\\/')
            ->kebab()
            ->finish('-');
    }
}
