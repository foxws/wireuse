<?php

namespace Foxws\WireUse\Models\Forms;

use Foxws\WireUse\Forms\Concerns\WithModel;
use Foxws\WireUse\Forms\Support\Form;

abstract class UpdateForm extends Form
{
    use WithModel;

    protected function handle(): void
    {
        //
    }

    protected function beforeValidate(): void
    {
        $this->authorize('update', $this->model);
    }
}
