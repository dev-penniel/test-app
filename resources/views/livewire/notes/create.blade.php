<?php

use Livewire\Volt\Component;

new class extends Component {
    public $content = '';
    public $editorId;

    public function mount()
    {
        $this->editorId = 'editor-' . uniqid();
    }

    // public function saveContent()
    // {
    //     // Process your content here
    //     // $this->content contains the Editor.js JSON output
    // }
}; ?>

<div>
    <div wire:ignore>
        <div id="{{ $editorId }}" class=""></div>
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
                        inlineToolbar: true
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