<?php

namespace Foxws\WireUse\Support\Livewire\StateObjects;

use Foxws\WireUse\Support\Concerns\WithHooks;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\Drawer\Utils;

class State implements Arrayable
{
    use WithHooks;

    public function __construct(
        protected Component $component,
        protected $propertyName,
    ) {
    }

    public function getComponent()
    {
        return $this->component;
    }

    public function getPropertyName()
    {
        return $this->propertyName;
    }

    public function all()
    {
        return $this->toArray();
    }

    public function only($properties)
    {
        $results = [];

        foreach (is_array($properties) ? $properties : func_get_args() as $property) {
            $results[$property] = $this->hasProperty($property) ? $this->getPropertyValue($property) : null;
        }

        return $results;
    }

    public function except($properties)
    {
        $properties = is_array($properties) ? $properties : func_get_args();

        return array_diff_key($this->all(), array_flip($properties));
    }

    public function hasProperty($prop)
    {
        return property_exists($this, Utils::beforeFirstDot($prop));
    }

    public function getPropertyValue($name)
    {
        $value = $this->{Utils::beforeFirstDot($name)};

        if (Utils::containsDots($name)) {
            return data_get($value, Utils::afterFirstDot($name));
        }

        return $value;
    }

    public function fill($values)
    {
        $values = $this->callHook('beforeStateFill', $values);

        $publicProperties = array_keys($this->all());

        if ($values instanceof Model) {
            $values = $values->toArray();
        }

        foreach ($values as $key => $value) {
            if (in_array(Utils::beforeFirstDot($key), $publicProperties)) {
                data_set($this, $key, $value);
            }
        }
    }

    public function reset(...$properties): void
    {
        $properties = count($properties) && is_array($properties[0])
            ? $properties[0]
            : $properties;

        if (empty($properties)) {
            $properties = array_keys($this->all());
        }

        $freshInstance = new static($this->getComponent(), $this->getPropertyName());

        foreach ($properties as $property) {
            data_set($this, $property, data_get($freshInstance, $property));
        }
    }

    public function toArray(): array
    {
        return Utils::getPublicProperties($this);
    }
}
