<?php

use Livewire\Component;
use App\Models\AssistanceRequest;

new class extends Component
{
    public AssistanceRequest $request;
    public $status;
    public $admin_notes;

    public function mount(AssistanceRequest $request)
    {
        $this->request = $request->load(['pillar', 'attachments.requirement']);
        $this->status = $request->status;
        $this->admin_notes = $request->admin_notes;
    }

    public function updateStatus()
    {
        $this->request->update([
            'status' => $this->status,
            'admin_notes' => $this->admin_notes,
        ]);

        $this->dispatch('notify', title: 'Berhasil', message: 'Status pengajuan telah diperbarui', type: 'success');
    }
};
?>

<div class="space-y-6 pb-20">
    <div class="flex items-center gap-4">
        <flux:button href="{{ route('admin.assistance.index') }}" icon="arrow-left" variant="ghost" />
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Pengajuan: {{ $request->ticket_number }}</h1>
            <p class="text-sm text-gray-500">Tinjau informasi pemohon dan berkas lampiran.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Data Diri -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="font-bold text-gray-900">Data Diri Pemohon</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Nama Lengkap</label>
                        <p class="font-semibold text-gray-900">{{ $request->name }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">NIK</label>
                        <p class="font-semibold text-gray-900">{{ $request->nik }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Nomor HP/WA</label>
                        <p class="font-semibold text-gray-900">{{ $request->phone }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase">Pilar Bantuan</label>
                        <p class="font-semibold text-emerald-700">{{ $request->pillar->title }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Alamat</label>
                        <p class="text-gray-900">{{ $request->address }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Alasan Pengajuan</label>
                        <p class="text-gray-900 bg-gray-50 p-4 rounded-lg border border-gray-100 italic">{{ $request->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Berkas Lampiran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="font-bold text-gray-900">Berkas Lampiran</h2>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($request->attachments as $attachment)
                        <div class="px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-gray-50 transition-colors">
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $attachment->requirement->name }}</p>
                                <p class="text-xs text-gray-500 uppercase">{{ $attachment->requirement->type }}</p>
                            </div>
                            <div>
                                @if($attachment->requirement->type == 'file' || $attachment->requirement->type == 'image')
                                    @if($attachment->value)
                                        <div class="flex gap-2">
                                            @if($attachment->requirement->type == 'image')
                                                <a href="{{ asset('storage/' . $attachment->value) }}" target="_blank" class="block w-20 h-20 rounded border border-gray-200 overflow-hidden">
                                                    <img src="{{ asset('storage/' . $attachment->value) }}" class="w-full h-full object-cover">
                                                </a>
                                            @endif
                                            <flux:button href="{{ asset('storage/' . $attachment->value) }}" target="_blank" icon="eye" size="sm" variant="ghost">Lihat Berkas</flux:button>
                                            <flux:button href="{{ asset('storage/' . $attachment->value) }}" download icon="arrow-down-tray" size="sm" variant="ghost">Download</flux:button>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400 italic">Tidak ada berkas</span>
                                    @endif
                                @else
                                    <p class="text-sm text-gray-700">{{ $attachment->value ?: '-' }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-12 text-center text-gray-500">
                            Tidak ada lampiran berkas.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column: Action -->
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-6 border-b pb-4">Tindakan Admin</h2>
                <form wire:submit="updateStatus" class="space-y-6">
                    <div>
                        <flux:select wire:model="status" label="Status Pengajuan">
                            <option value="pending">Menunggu</option>
                            <option value="reviewing">Sedang Direview/Survei</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </flux:select>
                    </div>
                    
                    <div>
                        <flux:textarea 
                            wire:model="admin_notes" 
                            label="Catatan Admin" 
                            placeholder="Berikan alasan persetujuan/penolakan atau instruksi selanjutnya untuk pemohon..."
                            rows="5"
                        />
                        <p class="text-[10px] text-gray-400 mt-2">* Catatan ini akan tampil di halaman pelacakan status publik.</p>
                    </div>

                    <flux:button type="submit" variant="primary" class="w-full">Perbarui Status</flux:button>
                </form>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-xl p-6">
                <h3 class="font-bold text-blue-900 mb-2">Informasi</h3>
                <p class="text-xs text-blue-700 leading-relaxed">
                    Setiap perubahan status akan langsung terlihat oleh pemohon saat mereka mengecek nomor tiket mereka di halaman publik. Pastikan catatan admin jelas jika ada dokumen yang perlu diperbaiki.
                </p>
            </div>
        </div>
    </div>
</div>
