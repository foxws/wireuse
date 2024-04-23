<?php

namespace Foxws\WireUse\Support\Components;

use Foxws\WireUse\Views\Concerns\WithHash;
use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Tappable;
use Livewire\Wireable;

abstract class Component extends Fluent implements Wireable
{
    use Conditionable;
    use Tappable;
    use WithHash;

    public function toLivewire(): array
    {
        return $this->toArray();
    }

    public static function fromLivewire($value): static
    {
        return new static($value);
    }
}
