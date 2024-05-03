<?php

namespace Foxws\WireUse;

use Foxws\WireUse\Support\Blade\Bladeable;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\ComponentAttributeBag;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WireUseServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('wireuse')
            ->hasConfigFile()
            ->hasViews()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile();
            });
    }

    public function packageRegistered()
    {
        $this->app->singleton(Bladeable::class);
    }

    public function bootingPackage(): void
    {
        $this
            ->registerFeatures()
            ->registerBladeMacros()
            ->registerAnonymousComponent()
            ->registerComponents()
            ->registerLivewire();
    }

    protected function registerFeatures(): static
    {
        foreach ([
            \Foxws\WireUse\Support\Livewire\ActionObjects\SupportActionObjects::class,
            \Foxws\WireUse\Support\Livewire\StateObjects\SupportStateObjects::class,
        ] as $feature) {
            app('livewire')->componentHook($feature);
        }

        return $this;
    }

    protected function registerBladeMacros(): static
    {
        if (config('wireuse.register_macros') === false) {
            return $this;
        }

        ComponentAttributeBag::macro('cssClass', function (array $values = []): ComponentAttributeBag {
            /** @var ComponentAttributeBag $this */
            foreach ($values as $key => $value) {
                $key = app(Bladeable::class)::classKeys($key)->first();

                if (! $this->has($key)) {
                    $this->offsetSet($key, $value);
                }
            }

            return $this;
        });

        ComponentAttributeBag::macro('classMerge', function (?array $values = null): ComponentAttributeBag {
            /** @var ComponentAttributeBag $this */
            $classes = app(Bladeable::class)::classMerged($this, $values)
                ->merge($this->get('class'))
                ->join(' ');

            $this->offsetSet('class', $classes);

            return $this
                ->sortClass()
                ->withoutClass();
        });

        ComponentAttributeBag::macro('sortClass', function (): ComponentAttributeBag {
            /** @var ComponentAttributeBag $this */
            $value = app(Bladeable::class)->sortClass(
                $this->get('class', '')
            );

            $this->offsetSet('class', $value);

            return $this;
        });

        ComponentAttributeBag::macro('withoutClass', function (): ComponentAttributeBag {
            /** @var ComponentAttributeBag $this */

            return $this
                ->whereDoesntStartWith('class:');
        });

        ComponentAttributeBag::macro('withoutWireModel', function (): ComponentAttributeBag {
            /** @var ComponentAttributeBag $this */

            return $this
                ->whereDoesntStartWith('wire:model');
        });

        ComponentAttributeBag::macro('mergeAttributes', function (array $values = []): ComponentAttributeBag {
            /** @var ComponentAttributeBag $this */
            foreach ($values as $key => $value) {
                $this->offsetSet($key, $value);
            }

            return $this;
        });

        ComponentAttributeBag::macro('classFor', function (string $key, string $default = ''): string {
            /** @var ComponentAttributeBag $this */
            $class = app(Bladeable::class)::classKeys($key)->first();

            return $this->get($class, $default);
        });

        ComponentAttributeBag::macro('wireModel', function (): mixed {
            /** @var ComponentAttributeBag $this */

            return $this->whereStartsWith('wire:model')->first();
        });

        ComponentAttributeBag::macro('wireKey', function (): mixed {
            /** @var ComponentAttributeBag $this */

            return $this->wireModel() ?: $this->first('id');
        });

        return $this;
    }

    protected function registerAnonymousComponent(): static
    {
        if (config('wireuse.register_components') === false) {
            return $this;
        }

        Blade::anonymousComponentPath(
            path: __DIR__.'/../resources/views/components',
            prefix: 'wireuse'
        );

        return $this;
    }

    protected function registerComponents(): static
    {
        if (config('wireuse.register_components') === false) {
            return $this;
        }

        WireUse::registerComponents(
            path: __DIR__,
            namespace: 'Foxws\\WireUse\\',
            prefix: config('wireuse.view_prefix'),
        );

        return $this;
    }

    protected function registerLivewire(): static
    {
        if (config('wireuse.register_components') === false) {
            return $this;
        }

        WireUse::registerLivewireComponents(
            path: __DIR__,
            namespace: 'Foxws\\WireUse\\',
            prefix: config('wireuse.view_prefix'),
        );

        return $this;
    }
}
