import Alpine from 'alpinejs'
import './tiptap-editor.js';
import './pemetaan-zakat.js';
import './payment-instructions-integration.js';

window.Alpine = Alpine

// Check if Alpine is already initialized before starting
// This prevents "Detected multiple instances of Alpine running" warning
if (!window.Alpine.startingUp && !window.Alpine._isRunning) {
    Alpine.start()
}

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Tiptap editors
    const contentEditors = document.querySelectorAll('[data-tiptap-editor]');
    
    contentEditors.forEach(async (editorContainer) => {
        const { initTiptapEditor, createEditorToolbar } = await import('./tiptap-editor.js');
        const inputElement = document.getElementById(editorContainer.dataset.tiptapInput);
        
        if (inputElement) {
            const editor = initTiptapEditor(editorContainer, inputElement);
            const toolbar = createEditorToolbar(editorContainer, editor);
            
            if (toolbar) {
                editorContainer.parentElement?.insertBefore(toolbar, editorContainer);
            }
        }
    });
});
