<x-layouts::app :title="__('Pengaturan Sistem')">

      <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Pengaturan</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola nilai fidyah, nisab, dan zakat fitrah</p>
      </div>

      @if(session('success'))
      <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
      </div>
      @endif

      <form action="{{ route('program.settings') }}" method="POST">
            @csrf @method('PUT')

            <div class="space-y-6">
                  @foreach($settings as $group => $groupSettings)
                  <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                              <h2 class="font-bold text-gray-900 capitalize">Pengaturan {{ ucfirst($group) }}</h2>
                        </div>
                        <div class="p-6 space-y-5">
                              @foreach($groupSettings as $setting)
                              <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-start">
                                    <div class="sm:col-span-1">
                                          <label for="setting_{{ $setting->key }}"
                                                class="block text-sm font-semibold text-gray-700">
                                                {{ $setting->label }}
                                          </label>
                                          @if($setting->deskripsi)
                                          <p class="text-xs text-gray-400 mt-0.5">{{ $setting->deskripsi }}</p>
                                          @endif
                                    </div>
                                    <div class="sm:col-span-2">
                                          <input type="text"
                                                id="setting_{{ $setting->key }}"
                                                name="settings[{{ $setting->key }}]"
                                                value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                                    </div>
                              </div>
                              @endforeach
                        </div>
                  </div>
                  @endforeach
            </div>

            <div class="mt-6 flex justify-end">
                  <button type="submit"
                        class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all shadow-sm hover:shadow-md">
                        Simpan Pengaturan
                  </button>
            </div>
      </form>

</x-layouts::app>