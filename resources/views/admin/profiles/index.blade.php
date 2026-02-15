<x-layouts::app :title="__('Sekilas NU Care')">
      <div class="min-h-screen  dark:from-zinc-900 dark:to-zinc-800 py-8 px-4">
            <div class="max-w-7xl mx-auto space-y-6">

                  <!-- Header Section -->
                  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                              <h1 class="text-3xl font-bold text-slate-900 dark:text-white flex items-center gap-3">
                                    Data Sekilas NU Care
                              </h1>
                              <p class="text-slate-600 dark:text-slate-400 mt-2">Kelola informasi profil organisasi</p>
                        </div>

                        <a
                              href="{{ route('profiles.create') }}"
                              class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-lg font-semibold shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40 transition-all duration-200 flex items-center justify-center gap-2 w-full md:w-auto">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                              </svg>
                              Tambah Profil
                        </a>
                  </div>

                  <!-- Stats Cards -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-slate-200 dark:border-zinc-800 p-6 hover:shadow-xl transition-shadow duration-200">
                              <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                                          <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                          </svg>
                                    </div>
                                    <div>
                                          <p class="text-sm text-slate-600 dark:text-slate-400 font-medium">Total Profil</p>
                                          <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $profiles->count() }}</p>
                                    </div>
                              </div>
                        </div>

                        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-slate-200 dark:border-zinc-800 p-6 hover:shadow-xl transition-shadow duration-200">
                              <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center">
                                          <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                          </svg>
                                    </div>
                                    <div>
                                          <p class="text-sm text-slate-600 dark:text-slate-400 font-medium">Total Penerima</p>
                                          <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($profiles->sum('penerima_manfaat'), 0, ',', '.') }}</p>
                                    </div>
                              </div>
                        </div>

                        <div class="bg-white dark:bg-zinc-900 rounded-xl shadow-lg border border-slate-200 dark:border-zinc-800 p-6 hover:shadow-xl transition-shadow duration-200">
                              <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                                          <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                          </svg>
                                    </div>
                                    <div>
                                          <p class="text-sm text-slate-600 dark:text-slate-400 font-medium">Total Program</p>
                                          <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($profiles->sum('program_tersalurkan'), 0, ',', '.') }}</p>
                                    </div>
                              </div>
                        </div>
                  </div>

                  <!-- Table Card -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 overflow-hidden">

                        <!-- Table Header -->
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-zinc-800">
                              <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Daftar Profil Organisasi</h2>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-50 dark:bg-zinc-800/50">
                                          <tr>
                                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                                      Judul Profil
                                                </th>
                                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                                      Tahun Berdiri
                                                </th>
                                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                                      Penerima Manfaat
                                                </th>
                                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider">
                                                      Program
                                                </th>
                                                <th class="px-6 py-4 text-center text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider w-48">
                                                      Aksi
                                                </th>
                                          </tr>
                                    </thead>

                                    <tbody class="divide-y divide-slate-200 dark:divide-zinc-800">
                                          @forelse($profiles as $profile)
                                          <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800/50 transition-colors duration-150">
                                                <td class="px-6 py-4">
                                                      <div class="flex items-center gap-3">
                                                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                                                  <span class="text-white font-bold text-sm">{{ substr($profile->title, 0, 2) }}</span>
                                                            </div>
                                                            <div>
                                                                  <p class="font-semibold text-slate-900 dark:text-white">{{ $profile->title }}</p>
                                                                  <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">ID: #{{ $profile->id }}</p>
                                                            </div>
                                                      </div>
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                      <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                                            {{ $profile->tahun_berdiri }}
                                                      </span>
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                      <span class="text-sm font-semibold text-slate-900 dark:text-white">
                                                            {{ number_format($profile->penerima_manfaat, 0, ',', '.') }}
                                                      </span>
                                                      <p class="text-xs text-slate-500 dark:text-slate-400">orang</p>
                                                </td>

                                                <td class="px-6 py-4 text-center">
                                                      <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                                                            {{ $profile->program_tersalurkan }}
                                                      </span>
                                                </td>

                                                <td class="px-6 py-4">
                                                      <div class="flex items-center justify-center gap-2">
                                                            <a
                                                                  href="{{ route('profiles.show', $profile) }}"
                                                                  class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-medium transition-colors duration-200 flex items-center gap-1.5"
                                                                  title="Lihat Detail">
                                                                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                  </svg>
                                                                  View
                                                            </a>

                                                            <a
                                                                  href="{{ route('profiles.edit', $profile) }}"
                                                                  class="px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-xs font-medium transition-colors duration-200 flex items-center gap-1.5"
                                                                  title="Edit Profil">
                                                                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                  </svg>
                                                                  Edit
                                                            </a>

                                                            <form method="POST" action="{{ route('profiles.destroy', $profile) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil ini?')">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                  <button
                                                                        type="submit"
                                                                        class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-xs font-medium transition-colors duration-200 flex items-center gap-1.5"
                                                                        title="Hapus Profil">
                                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                        </svg>
                                                                        Hapus
                                                                  </button>
                                                            </form>
                                                      </div>
                                                </td>
                                          </tr>
                                          @empty
                                          <tr>
                                                <td colspan="5" class="px-6 py-12 text-center">
                                                      <div class="flex flex-col items-center justify-center gap-3">
                                                            <div class="w-20 h-20 bg-slate-100 dark:bg-zinc-800 rounded-full flex items-center justify-center">
                                                                  <svg class="w-10 h-10 text-slate-400 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                                  </svg>
                                                            </div>
                                                            <div>
                                                                  <p class="text-slate-900 dark:text-white font-semibold">Belum ada data profil</p>
                                                                  <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Mulai dengan menambahkan profil baru</p>
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