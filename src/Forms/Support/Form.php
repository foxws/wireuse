<?php

namespace Foxws\WireUse\Forms\Support;

use Foxws\WireUse\Auth\Concerns\WithAuthorization;
use Foxws\WireUse\Exceptions\RateLimitedException;
use Foxws\WireUse\Forms\Concerns\WithSession;
use Foxws\WireUse\Forms\Concerns\WithThrottle;
use Foxws\WireUse\Forms\Concerns\WithValidation;
use Foxws\WireUse\Support\Concerns\WithHooks;
use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;
use Livewire\Form as BaseForm;

abstract class Form extends BaseForm
{
    use WithAuthorization;
    use WithHooks;
    use WithSession;
    use WithThrottle;
    use WithValidation;

    public function submit(): void
    {
        try {
            $this->rateLimit();

            $this->callHook('beforeValidate');

            $this->check();

            $this->callHook('afterValidate');

            $this->store();

            $this->callHook('beforeHandle');

            $this->handle();

            $this->callHook('afterHandle');
        } catch (RateLimitedException $e) {
            $this->handleThrottle($e);
        }
    }

    protected function handle(): void
    {
        //
    }

    protected function keys(): array
    {
        return array_keys($this->all());
    }

    public function fill($values)
    {
        $values = $this->callHook('beforeFill', $values);

        return parent::fill($values);
    }

    public function get(string $property, mixed $default = null): mixed
    {
        return $this->getPropertyValue($property) ?: $default;
    }

    public function has(...$properties): bool
    {
        return $this->toCollection()
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
        return $this->toCollection($properties)
            ->filter()
            ->isNotEmpty();
    }

    public function blank(...$properties): bool
    {
        return $this->toCollection($properties)
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

    protected function toCollection(...$properties): Collection
    {
        return $properties
            ? new Collection($this->only(...$properties))
            : new Collection($this->all());
    }

    protected function toFluent(...$properties): Fluent
    {
        return $properties
            ? new Fluent($this->only(...$properties))
            : new Fluent($this->all());
    }
}
