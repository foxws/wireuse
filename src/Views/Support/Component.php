<?php

namespace Foxws\WireUse\Views\Support;

use Foxws\WireUse\Views\Concerns\WithHash;
use Foxws\WireUse\Views\Concerns\WithLivewire;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\View\Component as BaseComponent;

abstract class Component extends BaseComponent
{
    use Conditionable;
    use Macroable;
    use WithHash;
    use WithLivewire;
}
