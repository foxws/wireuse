<?php

namespace Foxws\WireUse;

use Spatie\Html\Html;
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

    public function bootingPackage(): void
    {
        $this
            ->registerFeatures()
            ->registerMixins();
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
        if (! class_exists(Html::class)) {
            return $this;
        }

        foreach (config('wireuse.html.mixins', []) as $element => $mixin) {
            $element::mixin(new $mixin);
        }

        return $this;
    }
}
