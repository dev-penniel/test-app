<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <div class="relative mb-6 w-full">
        <div class="flex justify-between items-center">
            <div>
                <flux:heading size="xl" level="1">{{ __('Products') }}</flux:heading>
                <flux:breadcrumbs class="mb-4 mt-2">
                    <flux:breadcrumbs.item href="{{ route('dashboard') }}">Home</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item >Notes</flux:breadcrumbs.item>
                </flux:breadcrumbs>
            </div>
        </div>
        <flux:separator variant="subtle" />
    </div>
    <a wire:navigate href="{{ route('notes.create') }}"><flux:button size="sm" variant="primary" class="btn-sm"> <flux:icon.plus class="size-5" /> Add Note</flux:button></a>
</div>
