<?php

namespace Foxws\WireUse\Scout;

use Foxws\WireUse\Support\Discover\ComponentStructureScout;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Spatie\StructureDiscoverer\Data\DiscoveredStructure;

abstract class Scout
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
    ): static {
        return new static(
            path: $path,
            namespace: $namespace,
            prefix: $prefix,
        );
    }

    public function get(): Collection
    {
        return Cache::store($this->getCacheStore())->remember(
            $this->getCacheKey(),
            $this->getCacheLifetime(),
            fn () => $this->buildCollection()
        );
    }

    public function clear(): void
    {
        $this->getComponentStructures()->clear();

        Cache::store($this->getCacheStore())->forget($this->getCacheKey());
    }

    abstract protected function getComponentStructures(): ComponentStructureScout;

    protected function buildCollection(): Collection
    {
        $scout = $this->getComponentStructures();

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

    protected function getCacheKey(): string
    {
        return str('wireuse')
            ->append(class_basename(static::class), $this->prefix)
            ->snake();
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
