<?php

namespace Foxws\WireUse\Views\Components;

use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Auth\Concerns\WithAuthorization;
use Foxws\WireUse\States\Concerns\WithStates;
use Foxws\WireUse\Support\Concerns\WithHooks;
use Foxws\WireUse\Views\Concerns\WithSeo;
use Livewire\Component;

abstract class Page extends Component
{
    use WithAuthentication;
    use WithAuthorization;
    use WithHooks;
    use WithSeo;
    use WithStates;
}
