<?php

namespace Foxws\WireUse\Scout;

use Foxws\WireUse\Support\Discover\ComponentStructureScout;
use Illuminate\Support\Collection;
use Spatie\StructureDiscoverer\Data\DiscoveredStructure;

class ComponentScout
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
    ): self
    {
        return new self(
            path: $path,
            namespace: $namespace,
            prefix: $prefix,
        );
    }

    public function get(): Collection
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

    protected function getComponentStructures(): ComponentStructureScout
    {
        return ComponentStructureScout::create()
            ->path($this->path)
            ->prefix("blade-structures-{$this->prefix}");
    }
}
