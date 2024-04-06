<?php

namespace Foxws\WireUse\Models\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Locked;

abstract class UpdateForm extends Form
{
    #[Locked]
    public ?Model $model = null;

    public function submit(): void
    {
        $this->canUpdate($this->model);

        parent::submit();
    }

    public function delete(): void
    {
        $this->canDelete($this->model);

        $this->model->delete();
    }

    protected function set(Model $model): void
    {
        $this->canUpdate($model);

        $this->model = $model;
    }

    protected function handle(): void
    {
        $this->model->update(
            $this->all()
        );
    }
}
