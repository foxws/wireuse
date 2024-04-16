<?php

namespace Foxws\WireUse\Models\Forms;

use Foxws\WireUse\Forms\Support\Form;

abstract class CreateForm extends Form
{
    protected static ?string $model = null;

    public function submit(): void
    {
        $this->canCreate(static::modelClass());

        parent::submit();
    }

    protected function handle(): void
    {
        app(static::modelClass())::create(
            $this->all()
        );
    }

    protected static function modelClass(): ?string
    {
        return static::$model;
    }
}
