<?php

namespace Foxws\WireUse\Scout;

use Foxws\WireUse\Support\Discover\LivewireStructureScout;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Livewire;
use Spatie\StructureDiscoverer\Data\DiscoveredStructure;

class LivewireScout
{
    public function __construct(
        public ?string $path = null,
        public ?string $namespace = null,
        public ?string $prefix = null,
    ) {}

    public static function create(
        string $path,
        string $namespace = 'App\\',
        ?string $prefix = null,
    ): self {
        return new self(
            path: $path,
            namespace: $namespace,
            prefix: $prefix,
        );
    }

    public function register(): void
    {
        $this->get()->each(fn (array $component) => Livewire::component(...$component));
    }

    public function get(): Collection
    {
        return Cache::store($this->getCacheStore())->remember(
            $this->getCacheKey(),
            $this->getCacheLifetime(),
            fn () => $this->get()
        );
    }

    protected function buildCollection(): Collection
    {
        $scout = $this->getLivewireStructures();

        return Collection::make($scout->get())
            ->map(fn (DiscoveredStructure $class) => [
                'class' => $class->getFcqn(),
                'name' => $this->componentName($class),
            ]);
    }

    protected function componentName(DiscoveredStructure $class): string
    {
        return str($class->name)
            ->kebab()
            ->prepend(
                $this->componentPrefix(),
                $this->componentNamespace($class)
            );
    }

    protected function componentPrefix(): string
    {
        return str($this->prefix)
            ->replace('\\', '.')
            ->kebab();
    }

    protected function componentNamespace(DiscoveredStructure $class): string
    {
        return str($class->namespace)
            ->after($this->namespace)
            ->match('/(.*)\\\\/')
            ->replace('\\', '.')
            ->slug('.')
            ->finish('.');
    }

    protected function getLivewireStructures(): LivewireStructureScout
    {
        return LivewireStructureScout::create()
            ->path($this->path)
            ->prefix("livewire-structures-{$this->prefix}");
    }

    protected function getCacheKey(): string
    {
        return "wireuse.scout.livewire.{$this->prefix}";
    }

    protected function getCacheStore(): ?string
    {
        return config('wireuse.scout.cache_store');
    }

    protected function getCacheLifetime(): ?int
    {
        return config('wireuse.scout.cache_lifetime');
    }
}
