<x-layouts::app :title="__('Tambah User')">

    <div class="mb-6">
        <a href="{{ route('users.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-emerald-600 transition-colors mb-2">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke daftar user
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Tambah User Baru</h1>
    </div>

    <div class="max-w-3xl">
        <form action="{{ route('users.store') }}" method="POST" class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            @csrf
            <div class="p-6 space-y-5">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name') ? 'border-red-300 ring-red-100' : 'border-gray-300 focus:ring-emerald-500/20 focus:border-emerald-500' }} text-sm transition-all outline-none focus:ring-4">
                    @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-red-300 ring-red-100' : 'border-gray-300 focus:ring-emerald-500/20 focus:border-emerald-500' }} text-sm transition-all outline-none focus:ring-4">
                    @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-1.5">Role / Hak Akses</label>
                    <select name="role" id="role" required
                        class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('role') ? 'border-red-300 ring-red-100' : 'border-gray-300 focus:ring-emerald-500/20 focus:border-emerald-500' }} text-sm transition-all outline-none focus:ring-4 appearance-none bg-no-repeat bg-[right_1rem_center] bg-[length:1em_1em]"
                        style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke=%22%236b7280%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%222%22 d=%22M19 9l-7 7-7-7%22 /%3E%3C/svg%3E');">
                        <option value="">Pilih Role</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                        @endforeach
                    </select>
                    @error('role')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-red-300 ring-red-100' : 'border-gray-300 focus:ring-emerald-500/20 focus:border-emerald-500' }} text-sm transition-all outline-none focus:ring-4">
                        @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all outline-none focus:ring-4">
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('users.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-sm font-semibold hover:bg-gray-100 transition-all">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold transition-all shadow-sm hover:shadow-md">
                    Simpan User
                </button>
            </div>
        </form>
    </div>

</x-layouts::app>
