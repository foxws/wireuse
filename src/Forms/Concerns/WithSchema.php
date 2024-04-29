<?php

namespace Foxws\WireUse\Forms\Concerns;

use Foxws\WireUse\Forms\Support\Schema;

trait WithSchema
{
    public ?Schema $schema = null;

    public function hydrateWithSchema(): void
    {
        dd('hydrate');
    }
}
