<?php

namespace Foxws\WireUse\Auth\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;

class LoginForm extends Form
{
    protected static int $maxAttempts = 5;

    #[Validate]
    public string $email = '';

    #[Validate]
    public string $password = '';

    #[Validate]
    public bool $remember = false;

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'remember' => 'nullable|boolean',
            'password' => [
                'required',
                Password::defaults(),
            ],
        ];
    }

    protected function handle(): void
    {
        if (! Auth::attempt($this->only('email', 'password'), $this->remember)) {
            $this->addError('email', __('These credentials do not match our records'));

            return;
        }

        session()->regenerate();
    }

    protected function afterHandle(): mixed
    {
        return redirect()->intended();
    }
}
