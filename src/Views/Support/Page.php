<?php

namespace Foxws\WireUse\Views\Support;

use Foxws\WireUse\Auth\Concerns\WithAuthentication;
use Foxws\WireUse\Auth\Concerns\WithAuthorization;
use Foxws\WireUse\Views\Concerns\WithSeo;
use Livewire\Component;

abstract class Page extends Component
{
    use WithAuthentication;
    use WithAuthorization;
    use WithSeo;
}
