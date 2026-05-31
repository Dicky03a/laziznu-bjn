<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AssistanceRequest;

new class extends Component
{
    use WithPagination;

    public $status = '';
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        AssistanceRequest::find($id)->delete();
        $this->dispatch('notify', title: 'Berhasil', message: 'Pengajuan telah dihapus', type: 'success');
    }

    public function with()
    {
        return [
            'requests' => AssistanceRequest::with(['pillar'])
                ->when($this->status, fn($q) => $q->where('status', $this->status))
                ->when($this->search, function($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                      ->orWhere('ticket_number', 'like', "%{$this->search}%")
                      ->orWhere('nik', 'like', "%{$this->search}%");
                })
                ->latest()
                ->paginate(15),
        ];
    }
};
?>

<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Daftar Pengajuan Bantuan</h1>
            <p class="text-sm text-gray-500">Kelola dan tinjau semua permohonan bantuan dari masyarakat.</p>
        </div>
        <div class="flex gap-2">
            <flux:button href="{{ route('admin.assistance.requirements') }}" icon="cog-6-tooth" variant="ghost">Atur Syarat</flux:button>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 flex flex-col md:flex-row gap-4 items-center">
        <div class="flex-1 w-full">
            <flux:input wire:model.live.debounce.300ms="search" placeholder="Cari Nama, Tiket, atau NIK..." icon="magnifying-glass" />
        </div>
        <div class="w-full md:w-48">
            <flux:select wire:model.live="status">
                <option value="">Semua Status</option>
                <option value="pending">Menunggu</option>
                <option value="reviewing">Reviewing</option>
                <option value="approved">Disetujui</option>
                <option value="rejected">Ditolak</option>
            </flux:select>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-semibold">
                    <tr>
                        <th class="px-6 py-4">Pemohon</th>
                        <th class="px-6 py-4">Pilar</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($requests as $request)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $request->name }}</div>
                                <div class="text-xs text-gray-500 font-mono">{{ $request->ticket_number }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-700 font-medium">{{ $request->pillar?->title }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'reviewing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'approved' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                        'rejected' => 'bg-red-100 text-red-800 border-red-200',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold border {{ $statusClasses[$request->status] ?? '' }}">
                                    {{ strtoupper($request->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">{{ $request->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $request->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <flux:button href="{{ route('admin.assistance.show', $request) }}" icon="eye" variant="ghost" size="sm" />
                                    <flux:button wire:confirm="Hapus pengajuan ini?" wire:click="delete({{ $request->id }})" icon="trash" variant="ghost" size="sm" class="text-red-600" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                Tidak ada pengajuan yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($requests->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $requests->links() }}
            </div>
        @endif
    </div>
</div>
