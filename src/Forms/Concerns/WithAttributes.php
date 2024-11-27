<?php

namespace Foxws\WireUse\Forms\Concerns;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;

trait WithAttributes
{
    public function fill($values)
    {
        if (method_exists($this, 'beforeFill')) {
            $values = $this->beforeFill($values);
        }

        return parent::fill($values);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->request()->get($key, $default);
    }

    public function has(...$properties): bool
    {
        return $this->request()->hasAny($properties);
    }

    public function contains(string $key, mixed $value = null): bool
    {
        return $this->collect()->contains($key, $value);
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
        return $this->request()->filled($properties);
    }

    public function blank(...$properties): bool
    {
        return ! $this->filled($properties);
    }

    public function clear(bool $submit = true): void
    {
        $properties = $this->keys();

        $this->reset($properties);

        if ($submit && method_exists($this, 'submit')) {
            $this->submit();
        }
    }

    protected function keys(): array
    {
        return $this->request()->keys();
    }

    protected function request(): FormRequest
    {
        $this->validate();

        return (new FormRequest())->merge($this->all());
    }

    protected function collect(): Collection
    {
        return $this->request()->collect();
    }

    protected function fluent(): Fluent
    {
        return request()->fluent();
    }
}
