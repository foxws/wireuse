<?php

namespace Foxws\WireUse\Auth\Controllers;

use Foxws\WireUse\Auth\Forms\RegisterForm;
use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth')]
class RegisterController extends Page
{
    public RegisterForm $form;

    public function boot(): void
    {
        if (static::isAuthenticated()) {
            $this->redirectIntended();
        }
    }

    public function mount(): void
    {
        $this->seo()->setTitle(__('Register'));
        $this->seo()->setDescription(__('Sign up'));
    }

    public function render(): View
    {
        return view('wireuse::auth.register');
    }

    public function submit(): void
    {
        $this->form->submit();

        $this->redirect('/');
    }
}
