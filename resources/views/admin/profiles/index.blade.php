<x-layouts::app :title="__('Sekilas NU Care')">
      <div class="min-h-screen    py-8 px-4">
            <div class="max-w-7xl mx-auto space-y-6">

                  <!-- Header Section -->
                  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                              <h1 class="text-3xl font-bold text-slate-900  flex items-center gap-3">
                                    Data Sekilas NU Care
                              </h1>
                              <p class="text-slate-600  mt-2">Kelola informasi profil organisasi</p>
                        </div>
                  </div>

                  <!-- Stats Cards -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white  rounded-xl shadow-lg border border-slate-200  p-6 hover:shadow-xl transition-shadow duration-200">
                              <div class="flex items-center gap-4">
                                    <div>
                                          <p class="text-sm text-slate-600  font-medium">Total Penerima</p>
                                          <p class="text-2xl font-bold text-slate-900 ">{{ number_format($profiles->sum('penerima_manfaat'), 0, ',', '.') }}</p>
                                    </div>
                              </div>
                        </div>

                        <div class="bg-white  rounded-xl shadow-lg border border-slate-200  p-6 hover:shadow-xl transition-shadow duration-200">
                              <div class="flex items-center gap-4">
                                    <div>
                                          <p class="text-sm text-slate-600  font-medium">Total Program</p>
                                          <p class="text-2xl font-bold text-slate-900 ">{{ number_format($profiles->sum('program_tersalurkan'), 0, ',', '.') }}</p>
                                    </div>
                              </div>
                        </div>
                  </div>

                  <!-- Table Card -->
                  <div class="bg-white  rounded-2xl shadow-xl border border-slate-200  overflow-hidden">

                        <!-- Table Header -->
                        <div class="px-6 py-4 border-b border-slate-200 ">
                              <h2 class="text-lg font-semibold text-slate-900 ">Daftar Profil Organisasi</h2>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-50 ">
                                          <tr>
                                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700  uppercase tracking-wider">
                                                      Judul Profil
                                                </th>
                                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700  uppercase tracking-wider">
                                                      Tahun Berdiri
                                                </th>
                                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700  uppercase tracking-wider">
                                                      Penerima Manfaat
                                                </th>
                                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700  uppercase tracking-wider">
                                                      Program
                                                </th>
                                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700  uppercase tracking-wider w-48">
                                                      Aksi
                                                </th>
                                          </tr>
                                    </thead>

                                    <tbody class="divide-y divide-slate-200 ">
                                          @forelse($profiles as $profile)
                                          <tr class="hover:bg-slate-50  transition-colors duration-150">
                                                <td class="px-6 py-4">
                                                      <div class="flex items-center gap-3">
                                                            <div>
                                                                  <p class="font-semibold text-slate-900 ">{{ $profile->title }}</p>
                                                                  <p class="text-xs text-slate-500  mt-0.5">ID: #{{ $profile->id }}</p>
                                                            </div>
                                                      </div>
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                      <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800  ">
                                                            {{ $profile->tahun_berdiri }}
                                                      </span>
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                      <span class="text-sm font-semibold text-slate-900 ">
                                                            {{ number_format($profile->penerima_manfaat, 0, ',', '.') }}
                                                      </span>
                                                      <p class="text-xs text-slate-500 ">orang</p>
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                      <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800  ">
                                                            {{ $profile->program_tersalurkan }}
                                                      </span>
                                                </td>

                                                <td class="px-6 py-4">
                                                      <div class="flex items-center justify-center gap-2">
                                                            <a
                                                                  href="{{ route('profiles.show', $profile) }}"
                                                                  class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-medium transition-colors duration-200 flex items-center gap-1.5"
                                                                  title="Lihat Detail">
                                                                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                  </svg>
                                                                  View
                                                            </a>

                                                            <a
                                                                  href="{{ route('profiles.edit', $profile) }}"
                                                                  class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-medium transition-colors duration-200 flex items-center gap-1.5"
                                                                  title="Edit Profil">
                                                                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                  </svg>
                                                                  Edit
                                                            </a>
                                                      </div>
                                                </td>
                                          </tr>
                                          @empty
                                          <tr>
                                                <td colspan="5" class="px-6 py-12 text-center">
                                                      <div class="flex flex-col items-center justify-center gap-3">
                                                            <div class="w-20 h-20 bg-slate-100  rounded-full flex items-center justify-center">
                                                                  <svg class="w-10 h-10 text-slate-400 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                                  </svg>
                                                            </div>
                                                            <div>
                                                                  <p class="text-slate-900  font-semibold">Belum ada data profil</p>
                                                                  <p class="text-sm text-slate-500  mt-1">Mulai dengan menambahkan profil baru</p>
                                                            </div>
                                                            <a
                                                                  href="{{ route('profiles.create') }}"
                                                                  class="mt-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                                                                  Tambah Profil Pertama
                                                            </a>
                                                      </div>
                                                </td>
                                          </tr>
                                          @endforelse
                                    </tbody>
                              </table>
                        </div>

                  </div>
            </div>
      </div>
</x-layouts::app>