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
    <!-- Payment Instructions Modal -->
    @if ($this->isOpen)
    <div
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
        x-data
        @keydown.escape="$dispatch('close')">
        <div class="w-full max-w-md mx-auto bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl p-6">
            <!-- Modal Header -->
            <div class="mb-6 text-center">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white">
                    Informasi Penting
                </h2>
            </div>

            <!-- Divider -->
            <div class="border-t border-slate-200 dark:border-zinc-700 mb-6"></div>

            <!-- Payment Steps -->
            <div class="space-y-3 mb-6">
                <div class="flex items-start gap-3">
                    <span class="shrink-0 w-5 h-5 bg-emerald-600 text-white rounded-full flex items-center justify-center text-xs font-semibold">1</span>
                    <p class="text-sm text-slate-700 dark:text-slate-300 pt-0.5">Pastikan data yang disisi benar dan sesuai</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="shrink-0 w-5 h-5 bg-emerald-600 text-white rounded-full flex items-center justify-center text-xs font-semibold">2</span>
                    <p class="text-sm text-slate-700 dark:text-slate-300 pt-0.5">Lakukan pembayaran sesuai nominal yang ditentukan</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="shrink-0 w-5 h-5 bg-emerald-600 text-white rounded-full flex items-center justify-center text-xs font-semibold">3</span>
                    <p class="text-sm text-slate-700 dark:text-slate-300 pt-0.5">Pilih metode pembayaran yang tersedia</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="shrink-0 w-5 h-5 bg-emerald-600 text-white rounded-full flex items-center justify-center text-xs font-semibold">4</span>
                    <p class="text-sm text-slate-700 dark:text-slate-300 pt-0.5">Transfer ke rekening yang telah ditentukan</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="shrink-0 w-5 h-5 bg-emerald-600 text-white rounded-full flex items-center justify-center text-xs font-semibold">5</span>
                    <p class="text-sm text-slate-700 dark:text-slate-300 pt-0.5">Konfirmasi pembayaran dengan upload bukti transfer</p>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-slate-200 dark:border-zinc-700 my-6"></div>

            <!-- Warning -->
            <div class="flex items-start gap-3 mb-6 p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg border border-amber-200 dark:border-amber-800">
                <div class="shrink-0">
                </div>
                <p class="text-xs text-amber-800 dark:text-amber-200">
                    Pastikan transfer hanya dilakukan ke rekening resmi <strong>LAZISNU</strong> untuk keamanan Anda.
                </p>
            </div>

            <!-- Agreement Checkbox -->
            <div class="mb-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input
                        type="checkbox"
                        wire:model.live="hasAgreed"
                        class="w-4 h-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-sm text-slate-700 dark:text-slate-300">
                        Saya telah membaca dan memahami cara pembayaran di atas
                    </span>
                </label>
            </div>

            <!-- Divider -->
            <div class="border-t border-slate-200 dark:border-zinc-700 mb-6"></div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button
                    wire:click="close"
                    type="button"
                    class="flex-1 px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-zinc-800 rounded-lg hover:bg-slate-200 dark:hover:bg-zinc-700 transition-colors">
                    Batal
                </button>
                <button
                    wire:click="proceed"
                    type="button"
                    {{ ! $this->hasAgreed ? 'disabled' : '' }}
                    class="flex-1 px-4 py-2 text-sm font-semibold text-white rounded-lg transition-all {{ $this->hasAgreed ? 'bg-emerald-600 hover:bg-emerald-700 cursor-pointer' : 'bg-slate-300 dark:bg-zinc-600 cursor-not-allowed opacity-50' }}">
                    Saya Setuju & Lanjutkan
                </button>
            </div>
        </div>
    </div>
    @endif
</div>