<?php

namespace Foxws\WireUse\Auth\Controllers;

use Foxws\WireUse\Views\Support\Page;
use Illuminate\View\View;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth')]
class LogoutController extends Page
{
    public function mount(): void
    {
        $this->seo()->setTitle(__('Logout'));
        $this->seo()->setDescription(__('Account Logout'));

        $this->submit();
    }

    public function render(): View
    {
        return view('wireuse::auth.logout');
    }

    public function submit(): void
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        $this->redirect('/');
    }
}
