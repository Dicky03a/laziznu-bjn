<?php

use Livewire\Component;
use Livewire\Attributes\{On};

new class extends Component
{
    public bool $isOpen = false;
    public bool $hasAgreed = false;

    /**
     * Open the payment instructions modal
     */
    #[On('openPaymentInstructions')]
    public function open(): void
    {
        $this->isOpen = true;
        $this->hasAgreed = false;
    }

    /**
     * Close the modal
     */
    public function close(): void
    {
        $this->isOpen = false;
        $this->hasAgreed = false;
    }

    /**
     * Handle user agreement and proceed
     */
    public function proceed(): void
    {
        if ($this->hasAgreed) {
            // Close the modal
            $this->isOpen = false;
            $this->hasAgreed = false;

            // Dispatch JavaScript event using Alpine.js
            $this->js('document.dispatchEvent(new CustomEvent("paymentInstructionsAccepted"))');
        }
    }
};
?>

<div wire:key="payment-instructions">
    @if ($this->isOpen)
    <div
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        x-data
        @keydown.escape="$dispatch('close')">

        <!-- Modal -->
        <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl p-4 sm:p-6">

            <!-- Header -->
            <div class="mb-4 sm:mb-6 text-center">
                <h2 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white">
                    Informasi Penting
                </h2>
            </div>

            <div class="border-t border-slate-200 dark:border-zinc-700 mb-4 sm:mb-6"></div>

            <!-- Steps -->
            <div class="space-y-3 mb-4 sm:mb-6">
                @foreach([
                'Pastikan data yang disisi benar dan sesuai',
                'Lakukan pembayaran sesuai nominal yang ditentukan',
                'Pilih metode pembayaran yang tersedia',
                'Transfer ke rekening yang telah ditentukan',
                'Konfirmasi pembayaran dengan upload bukti transfer'
                ] as $i => $text)
                <div class="flex items-start gap-3">
                    <span class="shrink-0 w-5 h-5 bg-emerald-600 text-white rounded-full flex items-center justify-center text-xs font-semibold">
                        {{ $i + 1 }}
                    </span>
                    <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300">
                        {{ $text }}
                    </p>
                </div>
                @endforeach
            </div>

            <div class="border-t border-slate-200 dark:border-zinc-700 my-4 sm:my-6"></div>

            <!-- Warning -->
            <div class="flex items-start gap-3 mb-4 sm:mb-6 p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg border border-amber-200 dark:border-amber-800">
                <p class="text-xs text-amber-800 dark:text-amber-200">
                    Pastikan transfer hanya dilakukan ke rekening resmi <strong>LAZISNU</strong>.
                </p>
            </div>

            <!-- Checkbox -->
            <div class="mb-4 sm:mb-6">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        wire:model.live="hasAgreed"
                        class="mt-1 w-4 h-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-xs sm:text-sm text-slate-700 dark:text-slate-300">
                        Saya telah membaca dan memahami cara pembayaran di atas
                    </span>
                </label>
            </div>

            <div class="border-t border-slate-200 dark:border-zinc-700 mb-4 sm:mb-6"></div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                <button
                    wire:click="close"
                    type="button"
                    class="w-full px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-zinc-800 rounded-lg hover:bg-slate-200 dark:hover:bg-zinc-700 transition">
                    Batal
                </button>

                <button
                    wire:click="proceed"
                    type="button"
                    {{ ! $this->hasAgreed ? 'disabled' : '' }}
                    class="w-full px-4 py-2 text-sm font-semibold text-white rounded-lg transition-all 
                    {{ $this->hasAgreed 
                        ? 'bg-emerald-600 hover:bg-emerald-700' 
                        : 'bg-slate-300 dark:bg-zinc-600 cursor-not-allowed opacity-50' }}">
                    Saya Setuju & Lanjutkan
                </button>
            </div>

        </div>
    </div>
    @endif
</div>