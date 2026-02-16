import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';

export function initTiptapEditor(editorElement, inputElement) {
    if (!editorElement || !inputElement) return;

    const initialContent = inputElement.value || '';

    const editor = new Editor({
        element: editorElement,
        extensions: [
            StarterKit.configure({
                heading: {
                    levels: [1, 2, 3, 4, 5, 6]
                },
                link: {
                    openOnClick: false,
                    autolink: true,
                    defaultProtocol: 'https',
                }
            }),
            Image.configure({
                allowBase64: true,
                HTMLAttributes: {
                    class: 'max-w-full rounded-lg',
                }
            }),
        ],
        content: initialContent,
        onUpdate: ({ editor }) => {
            inputElement.value = editor.getHTML();
        },
        editorProps: {
            attributes: {
                class: 'tiptap focus:outline-none',
            },
        },
    });

    return editor;
}

export function createEditorToolbar(editorElement, editor) {
    if (!editor) return null;

    const toolbar = document.createElement('div');
    toolbar.className = 'tiptap-toolbar mb-2 p-3 bg-slate-50 dark:bg-zinc-800 border border-slate-300 dark:border-zinc-700 rounded-t-lg flex flex-wrap gap-2';

    const buttons = [
        { label: 'B', title: 'Bold', action: () => editor.chain().focus().toggleBold().run(), isActive: () => editor.isActive('bold') },
        { label: 'I', title: 'Italic', action: () => editor.chain().focus().toggleItalic().run(), isActive: () => editor.isActive('italic') },
        { label: 'U', title: 'Underline', action: () => editor.chain().focus().toggleUnderline().run(), isActive: () => editor.isActive('underline') },
        { label: 'S', title: 'Strikethrough', action: () => editor.chain().focus().toggleStrike().run(), isActive: () => editor.isActive('strike') },
        { type: 'divider' },
        { label: 'H1', title: 'Heading 1', action: () => editor.chain().focus().toggleHeading({ level: 1 }).run(), isActive: () => editor.isActive('heading', { level: 1 }) },
        { label: 'H2', title: 'Heading 2', action: () => editor.chain().focus().toggleHeading({ level: 2 }).run(), isActive: () => editor.isActive('heading', { level: 2 }) },
        { label: 'H3', title: 'Heading 3', action: () => editor.chain().focus().toggleHeading({ level: 3 }).run(), isActive: () => editor.isActive('heading', { level: 3 }) },
        { type: 'divider' },
        { label: 'UL', title: 'Bullet List', action: () => editor.chain().focus().toggleBulletList().run(), isActive: () => editor.isActive('bulletList') },
        { label: 'OL', title: 'Ordered List', action: () => editor.chain().focus().toggleOrderedList().run(), isActive: () => editor.isActive('orderedList') },
        { label: 'BQ', title: 'Blockquote', action: () => editor.chain().focus().toggleBlockquote().run(), isActive: () => editor.isActive('blockquote') },
        { type: 'divider' },
        { label: 'Code', title: 'Code Block', action: () => editor.chain().focus().toggleCodeBlock().run(), isActive: () => editor.isActive('codeBlock') },
        { label: 'Link', title: 'Add Link', action: () => addLink(editor) },
        { label: 'Image', title: 'Add Image', action: () => addImage(editor) },
        { type: 'divider' },
        { label: '⤴', title: 'Undo', action: () => editor.chain().focus().undo().run() },
        { label: '⤵', title: 'Redo', action: () => editor.chain().focus().redo().run() },
    ];

    buttons.forEach(button => {
        if (button.type === 'divider') {
            const divider = document.createElement('div');
            divider.className = 'w-px bg-slate-300 dark:bg-zinc-600';
            toolbar.appendChild(divider);
        } else {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.title = button.title;
            btn.textContent = button.label;
            btn.className = `px-3 py-1.5 rounded text-sm font-medium transition-colors ${
                button.isActive?.()
                    ? 'bg-blue-500 text-white'
                    : 'bg-white dark:bg-zinc-700 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-zinc-600 border border-slate-300 dark:border-zinc-600'
            }`;

            btn.addEventListener('click', (e) => {
                e.preventDefault();
                button.action();
                updateToolbar();
            });

            toolbar.appendChild(btn);
        }
    });

    const updateToolbar = () => {
        const btns = toolbar.querySelectorAll('button:not([title*="Undo"]):not([title*="Redo"]):not([title*="Link"]):not([title*="Image"])');
        btns.forEach(btn => {
            const button = buttons.find(b => b.label === btn.textContent && b.isActive);
            if (button?.isActive?.()) {
                btn.className = `px-3 py-1.5 rounded text-sm font-medium transition-colors bg-blue-500 text-white`;
            } else {
                btn.className = `px-3 py-1.5 rounded text-sm font-medium transition-colors bg-white dark:bg-zinc-700 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-zinc-600 border border-slate-300 dark:border-zinc-600`;
            }
        });
    };

    editor.on('update', updateToolbar);
    updateToolbar();

    return toolbar;
}

function addLink(editor) {
    const url = prompt('Enter URL:');
    if (url) {
        editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
    }
}

function addImage(editor) {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = (e) => {
        const file = e.target.files?.[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                const src = event.target?.result;
                editor.chain().focus().setImage({ src }).run();
            };
            reader.readAsDataURL(file);
        }
    };
    input.click();
}
