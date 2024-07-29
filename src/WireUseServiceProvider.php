<?php

namespace Foxws\WireUse;

use Foxws\WireUse\Scout\ComponentScout;
use Foxws\WireUse\Scout\LivewireScout;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WireUseServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('wireuse')
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        $this
            ->registerFeatures()
            ->registerMixins();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(ComponentScout::class, fn () => new ComponentScout);
        $this->app->singleton(LivewireScout::class, fn () => new LivewireScout);
    }

    protected function registerFeatures(): static
    {
        foreach ([
            \Foxws\WireUse\Support\Livewire\StateObjects\SupportStateObjects::class,
        ] as $feature) {
            app('livewire')->componentHook($feature);
        }

        return $this;
    }

    protected function registerMixins(): static
    {
        foreach (config('wireuse.html.mixins', []) as $element => $mixin) {
            $element::mixin(new $mixin);
        }

        return $this;
    }
}
