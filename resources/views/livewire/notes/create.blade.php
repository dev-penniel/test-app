<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public $content = '';
    public $editorId;

    public function mount()
    {
        $this->editorId = 'editor-' . uniqid();
    }

    public function createNote()
    {

        $validated = $this->validate([
            'content' => 'required',
        ]);

        Note::create([
            'note' => $validated['content']
        ]);

        $this->dispatch('note-created');
    }

    

}; ?>

<div>
    <div wire:ignore >
        <form wire:submit.ignore="createNote">
            <div id="{{ $editorId }}" class="" wire:model="content" wire:on></div>
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="note-created">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </div>
    
    {{-- <button wire:click="saveContent" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">
        Save Content
    </button> --}}

    @script
    <script>
        document.addEventListener('livewire:initialized', () => {
            const editorId = @js($editorId);
            const editor = new EditorJS({
                holder: editorId,
                tools: {
                    header: {
                        class: Header,
                        inlineToolbar: true,
                        config: {
                            placeholder: 'Enter header text...',
                            levels: [1, 2, 3, 4],
                            defaultLevel: 1,
                            // Custom CSS class for headers
                            defaultClassName: 'custom-header'
                        }
                    },
                    list: {
                        class: List,
                        inlineToolbar: true
                    },
                    code: Code,
                    inlineCode: {
                        class: InlineCode,
                    },
                    table: {
                        class: Table,
                        inlineToolbar: true
                    },
                    image: {
                        class: Image,
                        config: {
                            endpoints: {
                                byFile: '/upload-image', // Your image upload endpoint
                            }
                        }
                    }
                },
                
                placeholder: 'Start writing here...',

                data: @json($content ? json_decode($content, true) : null),
                onChange: async () => {
                    const output = await editor.save();
                    @this.set('content', JSON.stringify(output));
                }
            });
        });
    </script>
    @endscript
</div>