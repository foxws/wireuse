<?php

namespace Foxws\WireUse\Forms\Support;

use Illuminate\Database\Eloquent\Model;

abstract class UpdateForm extends Form
{
    public ?Model $model;

    protected function handle(): void
    {
        //
    }

    protected function beforeValidate(): void
    {
        $this->canUpdate($this->model);
    }

    protected function setModel(Model $model): void
    {
        $this->canUpdate($model);

        $this->model = $model;
    }

    protected function fillModelAttributes(...$attributes): void
    {
        $this->fill(
            $this->model?->only($attributes) ?? []
        );
    }
}
