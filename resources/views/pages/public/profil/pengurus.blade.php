@extends('layouts.public.app')
@section('title', 'Pengurus - Lazisnu Bojonegoro')
@section('content')


<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 text-white overflow-hidden">
      <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <p class="text-emerald-200 text-sm font-semibold tracking-widest uppercase mb-3">
                  Struktur Organisasi
            </p>
            <h1 class="text-3xl sm:text-4xl font-bold leading-tight mb-4">
                  Susunan Pengurus Cabang
            </h1>
            <h2 class="text-lg sm:text-xl font-semibold text-emerald-100 mb-2 leading-snug">
                  Lembaga Amil Zakat, Infaq dan Shadaqah<br>
                  Nahdlatul Ulama (LAZISNU)<br>
                  Kabupaten Bojonegoro
            </h2>

            @if($periodeAktif)
            <div class="inline-flex items-center gap-2 mt-5 bg-white/15 backdrop-blur border border-white/20 rounded-full px-5 py-2">
                  <svg class="w-4 h-4 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  <span class="font-semibold text-sm">
                        Masa Khidmat {{ $periodeAktif->masa_khidmat_mulai }}–{{ $periodeAktif->masa_khidmat_selesai }}
                  </span>
            </div>
            @endif

            @if($noSk)
            <p class="mt-3 text-xs text-emerald-300">
                  <span class="font-mono font-semibold text-white">{{ $noSk }}</span>
            </p>
            @endif
      </div>
</section>


<section class="bg-gray-50 py-16">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($pengurusByJabatan->isEmpty())
            <div class="text-center py-16 text-gray-400">
                  <svg class="w-16 h-16 mx-auto opacity-30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  <p class="font-medium">Data pengurus belum tersedia.</p>
            </div>
            @else

            @php
            $pimpinan = collect();
            foreach (['Ketua','Wakil Ketua','Sekretaris','Wakil Sekretaris'] as $jab) {
            if ($pengurusByJabatan->has($jab)) {
            foreach ($pengurusByJabatan[$jab] as $p) {
            $p->_jabatan_key = $jab;
            $pimpinan->push($p);
            }
            }
            }
            $anggota = $pengurusByJabatan->get('Anggota', collect());
            @endphp

            {{-- ─── Pimpinan Utama ─── --}}
            @if($pimpinan->isNotEmpty())
            <div class="mb-14">
                  <div class="bg-white items-center text-center rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        {{-- Header Card --}}
                        <div class="bg-emerald-50 px-5 py-3 border-b border-gray-100">
                              <p class="text-xs font-bold uppercase tracking-wider text-emerald-700">Pimpinan</p>
                              <h4 class="font-bold text-gray-800 text-sm leading-tight">Pengurus Inti</h4>
                        </div>

                        {{-- List Pimpinan --}}
                        {{-- List Pimpinan --}}
                        <div class="divide-y divide-gray-100">
                              @foreach($pimpinan as $p)
                              <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition">

                                    {{-- KIRI : Avatar + Nama --}}
                                    <div class="flex items-center gap-4 min-w-0">
                                          {{-- Avatar --}}
                                          <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 shadow-sm">
                                                @if($p->foto)
                                                <img src="{{ $p->foto_url }}" alt="{{ $p->nama }}"
                                                      class="w-full h-full object-cover object-top" />
                                                @else
                                                <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                                                      <span class="text-white font-bold text-base">
                                                            {{ strtoupper(substr($p->nama, 0, 1)) }}
                                                      </span>
                                                </div>
                                                @endif
                                          </div>

                                          {{-- Nama --}}
                                          <p class="font-semibold text-gray-900 text-sm truncate">
                                                {{ $p->nama_lengkap }}
                                          </p>
                                    </div>

                                    {{-- KANAN : Jabatan --}}
                                    <span class="text-xs font-semibold uppercase tracking-wide px-3 py-1 rounded-full
            {{ $p->jabatan == 'Ketua'
                ? 'bg-emerald-100 text-emerald-700'
                : 'bg-gray-100 text-gray-600' }}">
                                          {{ $p->jabatan }}
                                    </span>

                              </div>
                              @endforeach
                        </div>

                  </div>
            </div>
            @endif

            {{-- ─── Anggota Bidang ─── --}}
            @if($anggota->isNotEmpty())
            <div>
                  <div class="flex items-center gap-3 mb-8">
                        <div class="h-px flex-1 bg-gray-200"></div>
                        <h3 class="text-xs font-bold tracking-[0.2em] uppercase text-teal-700 bg-teal-50 px-4 py-1.5 rounded-full border border-teal-200">
                              Anggota Bidang
                        </h3>
                        <div class="h-px flex-1 bg-gray-200"></div>
                  </div>

                  @php
                  $anggotaByBidang = $anggota->groupBy('bidang');
                  @endphp

                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @foreach($anggotaByBidang as $bidang => $members)
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                              {{-- Header Bidang --}}
                              <div class="bg-gradient-to-r from-teal-50 to-emerald-50 px-5 py-3 border-b border-gray-100">
                                    <p class="text-xs font-bold uppercase tracking-wider text-teal-700">Bidang</p>
                                    <h4 class="font-bold text-gray-800 text-sm leading-tight">{{ $bidang ?: 'Umum' }}</h4>
                              </div>

                              {{-- Members list --}}
                              <div class="divide-y divide-gray-50">
                                    @foreach($members as $p)
                                    <div class="flex items-center gap-3 px-5 py-3.5">
                                          {{-- Small photo-fill avatar --}}
                                          <div class="w-11 h-11 rounded-2xl overflow-hidden shrink-0 shadow-sm">
                                                @if($p->foto)
                                                <img src="{{ $p->foto_url }}" alt="{{ $p->nama }}"
                                                      class="w-full h-full object-cover object-top" />
                                                @else
                                                <div class="w-full h-full bg-gradient-to-br from-teal-400 to-emerald-500 flex items-center justify-center">
                                                      <span class="text-white font-bold text-base">
                                                            {{ strtoupper(substr($p->nama, 0, 1)) }}
                                                      </span>
                                                </div>
                                                @endif
                                          </div>
                                          <div class="min-w-0">
                                                <p class="font-semibold text-gray-900 text-sm truncate">{{ $p->nama_lengkap }}</p>
                                                <p class="text-xs text-gray-400 truncate">Anggota</p>
                                          </div>
                                    </div>
                                    @endforeach
                              </div>
                        </div>
                        @endforeach
                  </div>
            </div>
            @endif

            @endif {{-- end isEmpty --}}
      </div>
</section>


<section class="bg-white border-t border-gray-200 py-8">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-gray-400">
                  Susunan pengurus berdasarkan SK PCNU Kabupaten Bojonegoro.
                  @if($periodeAktif)
                  Masa Khidmat {{ $periodeAktif->masa_khidmat_mulai }}–{{ $periodeAktif->masa_khidmat_selesai }}.
                  @endif
            </p>
      </div>
</section>

@endsection