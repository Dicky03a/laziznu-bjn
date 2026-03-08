import './tiptap-editor.js';


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
