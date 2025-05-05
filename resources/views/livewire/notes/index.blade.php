<?php

use Livewire\Volt\Component;
use App\Models\Note;
use Livewire\Attributes\On;
use Illuminate\Support\Str;


new class extends Component {
    
    public $notes = [];

    #[On('note-deleted')]
    public function mount(){

        $this->notes = Note::latest()->get();

    }


    public function deleteNote($id){

        $note = Note::findOrFail($id);
        $note->delete();
        $this->dispatch('note-deleted');

    }
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

    @foreach ($notes as $note)
        @php
            $noteData = json_decode($note->note, true);
            $firstHeader = collect($noteData['blocks'] ?? [])
                        ->firstWhere('type', 'header');
            $text = $firstHeader ? Str::limit(strip_tags($firstHeader['data']['text'] ?? ''), 20, '...') : '';
        @endphp

        @if($firstHeader)
            <div class="flex my-2 gap-5">
                <p>{{ $text }}</p>
                <flux:icon.trash class="cursor-pointer" color="red" wire:click="deleteNote({{ $note->id }})" />
            </div>
        @endif
    @endforeach

</div>
