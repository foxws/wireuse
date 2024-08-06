<?php

namespace Foxws\WireUse;

use Composer\InstalledVersions;
use Foxws\WireUse\Scout\ComponentScout;
use Foxws\WireUse\Scout\LivewireScout;
use Foxws\WireUse\Support\Html\Mixins\BaseElementMixin;
use Foxws\WireUse\Support\Html\Mixins\HtmlExtendedMixin;
use Foxws\WireUse\Support\Html\Mixins\LinkElementMixin;
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

    public function packageRegistered(): void
    {
        if (config('wireuse.scout.enabled', false)) {
            $this->registerStructureDiscovery();
        }
    }

    public function packageBooted(): void
    {
        $this
            ->registerFeatures()
            ->registerMixins();
    }

    protected function registerFeatures(): static
    {
        $features = config('wireuse.features', []);

        foreach ($features as $feature) {
            app('livewire')->componentHook($feature);
        }

        return $this;
    }

    protected function registerMixins(): static
    {
        if (config('wireuse.html.mixins', false)) {
            $this->registerHtmlMixins();
        }

        return $this;
    }

    protected function registerStructureDiscovery(): static
    {
        if (! InstalledVersions::isInstalled('spatie/php-structure-discoverer')) {
            abort(500, 'The spatie/php-structure-discoverer package is required to use the Strucute Scout.');
        }

        $this->app->singleton(ComponentScout::class, fn () => new ComponentScout);
        $this->app->singleton(LivewireScout::class, fn () => new LivewireScout);

        return $this;
    }

    protected function registerHtmlMixins(): static
    {
        if (! InstalledVersions::isInstalled('spatie/laravel-html')) {
            abort(500, 'The spatie/laravel-html package is required to use the HTML mixins.');
        }

        $mixins = [
            \Spatie\Html\Html::class => HtmlExtendedMixin::class,
            \Spatie\Html\BaseElement::class => BaseElementMixin::class,
            \Spatie\Html\Elements\A::class => LinkElementMixin::class,
        ];

        foreach ($mixins as $element => $mixin) {
            $element::mixin(new $mixin);
        }

        return $this;
    }
}
