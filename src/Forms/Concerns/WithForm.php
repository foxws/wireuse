<?php

namespace Foxws\WireUse\Forms\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use ReflectionProperty;

trait WithForm
{
    protected function getType(string $property): string
    {
        $instance = new ReflectionProperty(static::class, $property);

        return $instance->getType()->getName();
    }

    protected function collect(...$properties): Collection
    {
        return $properties
            ? collect($this->only(...$properties))
            : collect($this->all());
    }

    protected function keys(): array
    {
        return array_keys($this->all());
    }

    public function get(string $property, mixed $default = null): mixed
    {
        return $this->getPropertyValue($property) ?: $default;
    }

    public function has(...$properties): bool
    {
        return $this->collect()
            ->has($properties);
    }

    public function contains(string $property, mixed $args): bool
    {
        $propertyValue = $this->get($property);

        if (is_array($propertyValue)) {
            return in_array($args, $propertyValue);
        }

        return $propertyValue === $args;
    }

    public function is(string $property, mixed $args = null): bool
    {
        return $this->get($property) == $args;
    }

    public function isStrict(string $property, mixed $args = null): bool
    {
        return $this->get($property) === $args;
    }

    public function filled(...$properties): bool
    {
        return $this->collect($properties)
            ->filter()
            ->isNotEmpty();
    }

    public function blank(...$properties): bool
    {
        return $this->collect($properties)
            ->filter()
            ->isEmpty();
    }

    public function clear(bool $submit = true): void
    {
        $properties = $this->keys();

        $this->reset($properties);

        if ($submit && method_exists($this, 'submit')) {
            $this->submit();
        }
    }

    public function fails($rules = null, $messages = [], $attributes = []): bool
    {
        try {
            $this->parentValidate($rules, $messages, $attributes);
        } catch (ValidationException $e) {
            return invade($e->validator)->fails();
        }

        return false;
    }
}
