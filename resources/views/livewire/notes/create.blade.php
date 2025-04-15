<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div id="editorjs">

</div>

@script

<script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {

        const editor = new EditorJS({
            holder: 'editorjs',
            tools: { 
                header: {
                    class: Header,
                    config: {
                        placeholder: 'Enter a header',
                        levels: [2, 3, 4],
                        defaultLevel: 2
                    }
                },
                table: {
                    class: Table,
                    inlineToolbar: true
                },
            },
            placeholder: 'Start writing here...'
        });
        
        console.log('EditorJS initialized successfully');
    });
</script>

@endscript
