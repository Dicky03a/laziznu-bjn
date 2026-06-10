@extends('layouts.public.app')

@section('title', 'Form Pengajuan Bantuan - NU Care Lazisnu Bojonegoro')

@section('content')
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-600 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 lg:py-20">
        <div class="max-w-3xl">
            <nav class="flex items-center gap-2 text-sm text-gray-300 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                <span class="text-white font-medium">Pengajuan Bantuan</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                Layanan Pengajuan Bantuan
            </h1>
            <p class="text-gray-300 text-base sm:text-lg">
                Tersedia untuk masyarakat Bojonegoro yang membutuhkan bantuan melalui 5 Pilar LAZISNU.
            </p>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-16" x-data="assistanceForm()">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($errors->any())
        <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-600 text-sm shadow-sm">
            <p class="font-bold mb-2">Mohon perbaiki kesalahan berikut:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('assistance.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <!-- Step 1: Pilih Pilar -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8" x-show="step === 1" x-transition>
                <div class="flex items-center gap-3 mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Pilih Pilar Bantuan</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($pillars as $pillar)
                    <label class="relative flex flex-col p-5 bg-white border-2 rounded-2xl cursor-pointer hover:border-emerald-500 transition-all"
                        :class="pillarId == '{{ $pillar->id }}' ? 'border-emerald-600 bg-emerald-50 shadow-md' : 'border-gray-100'">
                        <input type="radio" name="pillar_id" value="{{ $pillar->id }}" class="sr-only" 
                            x-model="pillarId" @change="loadRequirements()">
                        <span class="text-lg font-bold text-gray-900">{{ $pillar->title }}</span>
                        <span class="text-xs text-gray-500 mt-2 leading-relaxed line-clamp-2">{{ $pillar->deskripsi }}</span>
                        <div class="absolute top-4 right-4 text-emerald-600" x-show="pillarId == '{{ $pillar->id }}'">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </label>
                    @endforeach
                </div>

                <div class="mt-10 flex justify-end">
                    <button type="button" @click="goToStep(2)" 
                        class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl shadow-lg hover:bg-emerald-700 transition-all disabled:opacity-50"
                        :disabled="!pillarId">
                        Lanjut ke Berkas
                    </button>
                </div>
            </div>

            <!-- Step 2: Berkas Pendukung -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8" x-show="step === 2" x-transition x-cloak>
                <div class="flex items-center gap-3 mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Lengkapi Berkas Pendukung</h2>
                </div>

                <div class="space-y-6" id="requirements-container">
                    <template x-for="req in requirements" :key="req.id">
                        <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100">
                            <label class="block text-sm font-bold text-gray-700 mb-2" x-text="req.name + (req.is_required ? ' *' : '')"></label>
                            
                            <template x-if="req.type === 'file' || req.type === 'image'">
                                <div>
                                    <input :type="'file'" :name="'requirement_' + req.id" :required="req.is_required"
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                    <p class="text-[10px] text-gray-400 mt-2">Maksimal ukuran file: 2MB</p>
                                </div>
                            </template>

                            <template x-if="req.type === 'text'">
                                <input type="text" :name="'requirement_' + req.id" :required="req.is_required"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            </template>

                            <template x-if="req.type === 'textarea'">
                                <textarea :name="'requirement_' + req.id" :required="req.is_required" rows="3"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"></textarea>
                            </template>
                        </div>
                    </template>

                    <div x-show="requirements.length === 0" class="py-10 text-center text-gray-400 italic">
                        Tidak ada berkas tambahan yang diperlukan untuk pilar ini.
                    </div>
                </div>

                <div class="mt-10 flex justify-between">
                    <button type="button" @click="goToStep(1)" class="px-8 py-3 text-emerald-600 font-bold hover:bg-emerald-50 rounded-xl transition-all">Kembali</button>
                    <button type="button" @click="goToStep(3)" class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl shadow-lg hover:bg-emerald-700 transition-all">Lanjut ke Data Diri</button>
                </div>
            </div>

            <!-- Step 3: Data Diri -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8" x-show="step === 3" x-transition x-cloak>
                <div class="flex items-center gap-3 mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Data Diri & Alasan</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">NIK (KTP) <span class="text-red-500">*</span></label>
                        <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16" placeholder="16 digit NIK"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Sesuai KTP"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">No. WhatsApp <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="08xxxxxxxxxx"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="address" required rows="3" placeholder="Alamat tinggal saat ini"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">{{ old('address') }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Alasan/Tujuan Bantuan <span class="text-red-500">*</span></label>
                        <textarea name="description" required rows="4" placeholder="Ceritakan kondisi dan mengapa Anda membutuhkan bantuan ini..."
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="mt-10 flex justify-between">
                    <button type="button" @click="goToStep(2)" class="px-8 py-3 text-emerald-600 font-bold hover:bg-emerald-50 rounded-xl transition-all">Kembali</button>
                    <button type="submit" class="px-10 py-4 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">Kirim Pengajuan</button>
                </div>
            </div>
        </form>
        
        <!-- Info -->
        <div class="mt-12 bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Informasi Penting
            </h3>
            <ul class="space-y-3 text-sm text-gray-600">
                <li class="flex gap-3">
                    <span class="text-emerald-500 font-bold">●</span>
                    <span>Pastikan berkas yang diunggah terbaca dengan jelas (tidak buram).</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-emerald-500 font-bold">●</span>
                    <span>Tim kami akan menghubungi Anda melalui WhatsApp jika diperlukan survei.</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-emerald-500 font-bold">●</span>
                    <span>Simpan Nomor Tiket yang muncul setelah Anda berhasil mengirim pengajuan.</span>
                </li>
            </ul>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function assistanceForm() {
        return {
            step: {{ $errors->any() ? (old('nik') || old('name') ? 3 : 2) : 1 }},
            pillarId: '{{ old("pillar_id") }}',
            requirements: [],
            
            async loadRequirements() {
                if (!this.pillarId) return;
                
                try {
                    const response = await fetch(`{{ url('/pengajuan-bantuan/syarat') }}/${this.pillarId}`);
                    if (response.ok) {
                        this.requirements = await response.json();
                    }
                } catch (error) {
                    console.error('Error loading requirements:', error);
                }
            },
            
            goToStep(n) {
                if (n > this.step) {
                    // Simple validation could go here
                }
                this.step = n;
                window.scrollTo({ top: 300, behavior: 'smooth' });
            },

            init() {
                if (this.pillarId) {
                    this.loadRequirements();
                }
            }
        }
    }
</script>
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush
@endsection
