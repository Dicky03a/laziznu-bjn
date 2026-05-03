import Alpine from 'alpinejs'
import './payment-instructions-integration.js';

window.Alpine = Alpine

document.addEventListener('DOMContentLoaded', () => {
    // 1. Lazy Load Tiptap (Dynamic Import)
    const contentEditors = document.querySelectorAll('[data-tiptap-editor]');
    if (contentEditors.length > 0) {
        contentEditors.forEach(async (editorContainer) => {
            const { initTiptapEditor, createEditorToolbar } = await import('./tiptap-editor.js');
            const inputId = editorContainer.getAttribute('data-tiptap-input');
            const inputElement = document.getElementById(inputId);
            
            if (inputElement) {
                const editor = initTiptapEditor(editorContainer, inputElement);
                if (editor) {
                    const toolbar = createEditorToolbar(editorContainer, editor);
                    if (toolbar) {
                        editorContainer.parentNode.insertBefore(toolbar, editorContainer);
                    }
                }
            }
        });
    }

    // 2. Lazy Load Peta dengan Intersection Observer
    const mapTarget = document.getElementById('peta-zakat');
    if (mapTarget) {
        const mapObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Hanya import file peta saat akan terlihat
                    import('./pemetaan-zakat.js').then(module => {
                        module.initPemetaanZakat();
                    });
                    mapObserver.unobserve(mapTarget); // Stop observing setelah load
                }
            });
        }, { rootMargin: '200px' }); // Load 200px sebelum muncul di viewport

        mapObserver.observe(mapTarget);
    }
});