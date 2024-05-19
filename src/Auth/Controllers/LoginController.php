<?php

namespace Foxws\WireUse\Auth\Controllers;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Auth\Forms\LoginForm;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth')]
class LoginController extends Page
{
    public LoginForm $form;

    public function boot(): void
    {
        if (static::isAuthenticated()) {
            $this->redirectIntended();
        }
    }

    public function mount(): void
    {
        $this->seo()->setTitle(__('Login'));
        $this->seo()->setDescription(__('Login to Account'));
    }

    public function render(): View
    {
        return view('wireuse::auth.login')->with([
            'actions' => $this->actions(),
        ]);
    }

    public function submit(): void
    {
        $this->form->submit();

        $this->redirectIntended();
    }

    protected function actions(): array
    {
        return [
            Action::make('submit')
                ->label(__('Login'))
                ->componentAttributes([
                    'type' => 'submit',
                ]),
        ];
    }
}
