<?php

namespace Foxws\WireUse;

use Foxws\WireUse\Support\Blade\Bladeable;
use Foxws\WireUse\Support\Html\Mixins;
use Spatie\Html\BaseElement;
use Spatie\Html\Elements;
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

    public function packageRegistered()
    {
        $this->app->singleton(Bladeable::class);
    }

    public function bootingPackage(): void
    {
        $this
            ->registerFeatures()
            ->registerHtml();
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

    protected function registerHtml(): static
    {
        // Extend BaseElement
        Html::mixin(new Mixins\HtmlExtendedMixin);
        BaseElement::mixin(new Mixins\BaseElementMixin);

        // Extend Elements
        Elements\A::mixin(new Mixins\LinkElementMixin);
        Elements\Img::mixin(new Mixins\ImgElementMixin);

        return $this;
    }
}
