<form wire:submit="submit">
    <x-wireuse::forms.input
        label="{{ __('Email') }}"
        id="form.email"
        type="email"
        wire:model.live="form.email"
    />

    <x-wireuse::forms.input
        label="{{ __('Password') }}"
        id="form.password"
        type="password"
        wire:model.live="form.password"
    />

    @foreach ($actions as $action)
        <x-wireuse::actions-button :$action />
    @endforeach
</form>
