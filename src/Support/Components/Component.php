<?php

namespace Foxws\WireUse\Support\Components;

use Foxws\WireUse\Views\Concerns\WithHash;
use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Tappable;

abstract class Component extends Fluent
{
    use Conditionable;
    use Tappable;
    use WithHash;
}
