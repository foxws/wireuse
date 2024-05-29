<form wire:submit="submit">
    <x-wireuse::forms.input
        type="email"
        wire:model.blur="form.email"
        label="{{ __('Email') }}"
        id="form.email"
    />

    <x-wireuse::forms.input
        type="password"
        wire:model.blur="form.password"
        label="{{ __('Password') }}"
        id="form.password"
    />

    @foreach ($actions as $action)
        <x-wireuse::actions-button :$action />
    @endforeach
</form>
