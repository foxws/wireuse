<?php

namespace Foxws\WireUse\Actions\Concerns;

use Closure;
use Illuminate\View\View;

trait HasView
{
    public function view(View|Closure|string|null $view = null): static
    {
        $this->view = $view;

        return $this;
    }
}
