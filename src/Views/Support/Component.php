<?php

namespace Foxws\WireUse\Views\Support;

use Foxws\WireUse\Views\Concerns\Hashable;
use Foxws\WireUse\Views\Concerns\Livewireable;
use Illuminate\Support\Traits\Conditionable;
use Illuminate\Support\Traits\Tappable;
use Illuminate\View\Component as BaseComponent;

abstract class Component extends BaseComponent
{
    use Conditionable;
    use Hashable;
    use Livewireable;
    use Tappable;
}
