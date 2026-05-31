<?php

use Livewire\Component;
use App\Models\Pillars;
use App\Models\AssistanceRequirement;

new class extends Component
{
    public $selectedPillarId;
    public $requirements = [];
    public $pillars = [];

    // Form fields
    public $name;
    public $type = 'file';
    public $is_required = true;
    public $editingId = null;

    public function mount()
    {
        $this->pillars = Pillars::orderBy('urutan')->get();
        if ($this->pillars->count() > 0) {
            $this->selectPillar($this->pillars->first()->id);
        }
    }

    public function selectPillar($id)
    {
        $this->selectedPillarId = $id;
        $this->loadRequirements();
        $this->resetForm();
    }

    public function loadRequirements()
    {
        $this->requirements = AssistanceRequirement::where('pillar_id', $this->selectedPillarId)->get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:file,image,text,textarea',
            'is_required' => 'boolean',
        ]);

        if ($this->editingId) {
            AssistanceRequirement::find($this->editingId)->update([
                'name' => $this->name,
                'type' => $this->type,
                'is_required' => $this->is_required,
            ]);
        } else {
            AssistanceRequirement::create([
                'pillar_id' => $this->selectedPillarId,
                'name' => $this->name,
                'type' => $this->type,
                'is_required' => $this->is_required,
            ]);
        }

        $this->resetForm();
        $this->loadRequirements();
        $this->dispatch('notify', title: 'Berhasil', message: 'Syarat pengajuan telah disimpan', type: 'success');
    }

    public function edit($id)
    {
        $req = AssistanceRequirement::find($id);
        $this->editingId = $req->id;
        $this->name = $req->name;
        $this->type = $req->type;
        $this->is_required = (bool) $req->is_required;
    }

    public function delete($id)
    {
        AssistanceRequirement::find($id)->delete();
        $this->loadRequirements();
        $this->dispatch('notify', title: 'Berhasil', message: 'Syarat pengajuan telah dihapus', type: 'success');
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->name = '';
        $this->type = 'file';
        $this->is_required = true;
    }
};
?>

<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pengaturan Syarat Pengajuan</h1>
            <p class="text-sm text-gray-500">Atur syarat dokumen atau data yang harus diunggah masyarakat berdasarkan pilar bantuan.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar: Pillars -->
        <div class="lg:col-span-1 space-y-2">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider px-3 mb-3">Pilih Pilar</h3>
            @foreach($pillars as $pillar)
                <button
                    wire:click="selectPillar({{ $pillar->id }})"
                    class="w-full text-left px-4 py-3 rounded-lg transition-all duration-200 {{ $selectedPillarId == $pillar->id ? 'bg-emerald-600 text-white shadow-md font-bold' : 'bg-white hover:bg-gray-50 text-gray-700 border border-gray-200' }}"
                >
                    {{ $pillar->title }}
                </button>
            @endforeach
        </div>

        <!-- Main: Requirements List & Form -->
        <div class="lg:col-span-3 space-y-6">
            @if($selectedPillarId)
                <!-- Form Add/Edit -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">{{ $editingId ? 'Edit Syarat' : 'Tambah Syarat Baru' }}</h2>
                    <form wire:submit="save" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <div class="md:col-span-2">
                            <flux:input wire:model="name" label="Nama Syarat" placeholder="Contoh: Foto KTP / Surat Keterangan" />
                        </div>
                        <div>
                            <flux:select wire:model="type" label="Jenis Input">
                                <option value="file">File (PDF/DOC)</option>
                                <option value="image">Gambar (JPG/PNG)</option>
                                <option value="text">Teks Singkat</option>
                                <option value="textarea">Teks Panjang</option>
                            </flux:select>
                        </div>
                        <div class="flex items-center gap-4 mb-2">
                            <flux:checkbox wire:model="is_required" label="Wajib Isi" />
                            <div class="flex gap-2 ml-auto">
                                @if($editingId)
                                    <flux:button wire:click="resetForm" variant="ghost">Batal</flux:button>
                                @endif
                                <flux:button type="submit" variant="primary">Simpan</flux:button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- List of Requirements -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="font-bold text-gray-900">Daftar Syarat untuk: {{ $pillars->find($selectedPillarId)->title }}</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($requirements as $req)
                            <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $req->name }}</p>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="text-xs px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 font-medium uppercase">{{ $req->type }}</span>
                                        @if($req->is_required)
                                            <span class="text-xs text-red-600 font-bold">* Wajib</span>
                                        @else
                                            <span class="text-xs text-gray-500 italic">Opsional</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <flux:button wire:click="edit({{ $req->id }})" icon="pencil-square" variant="ghost" size="sm" />
                                    <flux:button wire:confirm="Hapus syarat ini?" wire:click="delete({{ $req->id }})" icon="trash" variant="ghost" size="sm" class="text-red-600" />
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-12 text-center text-gray-500">
                                <p>Belum ada syarat khusus untuk pilar ini.</p>
                                <p class="text-xs mt-1">Gunakan form di atas untuk menambahkan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
