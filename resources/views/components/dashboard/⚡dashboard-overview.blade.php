<?php

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Program;
use App\Models\QurbanRegistration;
use App\Models\QurbanPeriod;
use App\Models\PaymentConfirmation;
use App\Models\News;
use App\Models\Mustahik;

new class extends Component
{
    public $totalConfirmed = 0;
    public $totalPending = 0;
    public $totalRejected = 0;
    public $totalAmount = 0;
    public $activePrograms = 0;
    public $totalPrograms = 0;
    public $recentTransactions = [];
    public $pendingTransactions = [];
    public $pendingPaymentConfirmations = [];
    public $topPrograms = [];
    public $qurbanStats = [];
    public $totalMustahik = 0;
    public $totalNews = 0;
    public $unpublishedNews = 0;
    public $monthlyIncome = 0;
    public $dailyIncome = 0;

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Transaction stats
        $this->totalConfirmed = Transaction::where('status', 'confirmed')->count();
        $this->totalPending = Transaction::where('status', 'pending')->count();
        $this->totalRejected = Transaction::where('status', 'rejected')->count();
        $this->totalAmount = Transaction::where('status', 'confirmed')->sum('jumlah') ?? 0;

        // Program stats
        $this->activePrograms = Program::where('is_active', 1)->count();
        $this->totalPrograms = Program::count();

        // Mustahik stats
        $this->totalMustahik = Mustahik::count();

        // News stats
        $this->totalNews = News::whereNotNull('published_at')->count();
        $this->unpublishedNews = News::whereNull('published_at')->count();

        // Monthly and daily income
        $today = now()->startOfDay();
        $monthStart = now()->startOfMonth();
        $this->dailyIncome = Transaction::where('status', 'confirmed')
            ->whereDate('created_at', $today)
            ->sum('jumlah') ?? 0;
        $this->monthlyIncome = Transaction::where('status', 'confirmed')
            ->whereBetween('created_at', [$monthStart, now()])
            ->sum('jumlah') ?? 0;

        // Recent confirmed transactions
        $this->recentTransactions = Transaction::where('status', 'confirmed')
            ->with('program')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get(['id', 'kode_transaksi', 'nama_donatur', 'jumlah', 'program_id', 'created_at']);

        // Pending transactions
        $this->pendingTransactions = Transaction::where('status', 'pending')
            ->with('program')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get(['id', 'kode_transaksi', 'nama_donatur', 'jumlah', 'program_id', 'created_at']);

        // Pending payment confirmations
        $this->pendingPaymentConfirmations = PaymentConfirmation::whereHas('transaction', function ($query) {
            $query->where('status', 'pending');
        })->with('transaction')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Top programs by donations
        $this->topPrograms = Program::withCount(['transactions' => function ($query) {
            $query->where('status', 'confirmed');
        }])
            ->withSum(['transactions' => function ($query) {
                $query->where('status', 'confirmed');
            }], 'jumlah')
            ->where('is_active', 1)
            ->take(6)
            ->get();

        // Qurban stats
        $activePeriod = QurbanPeriod::where('is_active', 1)->first();
        if ($activePeriod) {
            $totalQurbanRegs = QurbanRegistration::where('period_id', $activePeriod->id)->count();
            $confirmedQurbanRegs = QurbanRegistration::where('period_id', $activePeriod->id)
                ->where('status', 'confirmed')
                ->count();
            $totalQurbanAmount = QurbanRegistration::where('period_id', $activePeriod->id)
                ->where('status', 'confirmed')
                ->sum('total_bayar') ?? 0;

            $this->qurbanStats = [
                'period_name' => $activePeriod->nama,
                'total_registrations' => $totalQurbanRegs,
                'confirmed_registrations' => $confirmedQurbanRegs,
                'total_amount' => $totalQurbanAmount,
            ];
        }
    }

    public function confirmTransaction($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->update(['status' => 'confirmed', 'confirmed_at' => now()]);
            $this->dispatch('notify', title: 'Berhasil', message: 'Donasi telah dikonfirmasi', type: 'success');
            $this->loadDashboardData();
        }
    }

    public function rejectTransaction($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->update(['status' => 'rejected']);
            $this->dispatch('notify', title: 'Berhasil', message: 'Donasi telah ditolak', type: 'success');
            $this->loadDashboardData();
        }
    }
};
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap');

    :root {
        --primary: #1e40af;
        --primary-dark: #1e3a8a;
        --success: #16a34a;
        --warning: #ca8a04;
        --danger: #dc2626;
        --info: #0284c7;
        --border: #e5e7eb;
        --border-dark: #374151;
    }

    [class*='dark'] {
        --border: #374151;
    }

    html {
        font-family: 'Poppins', sans-serif;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Poppins', sans-serif;
    }
</style>

<div class="min-h-screen dark:from-gray-900 dark:to-gray-950">
    <!-- Header Section -->
    <div class="sticky top-0 z-40 bg-white dark:bg-gray-800/95 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700">
        <div class="px-4 sm:px-6 lg:px-8 py-6 mx-auto">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white tracking-tight">Dashboard Admin</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ now()->format('l, d F Y') }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('programs.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-all duration-200 font-medium text-sm shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Kelola Program
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-2 sm:px-6 lg:px-8 py-8  mx-auto">
        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 mb-8">
            <!-- Confirmed Card -->
            <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Dikonfirmasi</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalConfirmed }}</p>
                        <p class="text-xs text-green-600 dark:text-green-400 font-semibold mt-2">Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Card -->
            <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Menunggu</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalPending }}</p>
                        <p class="text-xs text-yellow-600 dark:text-yellow-400 font-semibold mt-2">Segera Diverifikasi</p>
                    </div>
                    <div class="p-3 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Rejected Card -->
            <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Ditolak</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalRejected }}</p>
                        <p class="text-xs text-red-600 dark:text-red-400 font-semibold mt-2">Tidak Diproses</p>
                    </div>
                    <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2m2-2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Monthly Income Card -->
            <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Bulan Ini</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Rp {{ number_format($monthlyIncome, 0, ',', '.') }}</p>
                        <p class="text-xs text-blue-600 dark:text-blue-400 font-semibold mt-2">{{ now()->format('F') }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Daily Income Card -->
            <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-2">Rp {{ number_format($dailyIncome, 0, ',', '.') }}</p>
                        <p class="text-xs text-indigo-600 dark:text-indigo-400 font-semibold mt-2">{{ now()->format('d M') }}</p>
                    </div>
                    <div class="p-3 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Programs Card -->
            <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Program</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $activePrograms }}<span class="text-lg text-gray-500 dark:text-gray-400">/{{ $totalPrograms }}</span></p>
                        <p class="text-xs text-purple-600 dark:text-purple-400 font-semibold mt-2">Aktif</p>
                    </div>
                    <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Pending Transactions Section -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <!-- Header -->
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-transparent dark:from-gray-700/50">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Donasi Menunggu Verifikasi</h2>
                                @if ($totalPending > 0)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $totalPending }} donasi memerlukan tindakan Anda</p>
                                @endif
                            </div>
                            @if ($totalPending > 0)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800/50">
                                {{ $totalPending }} Item
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($pendingTransactions as $transaction)
                        <div class="px-6 py-5 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150 group">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-2">
                                        <h3 class="font-semibold text-gray-900 dark:text-white truncate text-sm">{{ $transaction->nama_donatur }}</h3>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 border border-yellow-200 dark:border-yellow-800/50 whitespace-nowrap">Pending</span>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 font-mono mb-2">{{ $transaction->kode_transaksi }}</p>
                                    <div class="grid grid-cols-2 gap-3 text-xs text-gray-600 dark:text-gray-400">
                                        <div>
                                            <span class="text-gray-500 dark:text-gray-500">Program:</span>
                                            <p class="font-medium text-gray-900 dark:text-gray-100 mt-0.5">{{ $transaction->program?->nama ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500 dark:text-gray-500">Diterima:</span>
                                            <p class="font-medium text-gray-900 dark:text-gray-100 mt-0.5">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right sm:text-right">
                                    <p class="text-xl font-bold text-gray-900 dark:text-white mb-3">Rp {{ number_format($transaction->jumlah, 0, ',', '.') }}</p>
                                    <div class="flex gap-2 justify-start sm:justify-end">
                                        <button wire:click="confirmTransaction({{ $transaction->id }})" class="inline-flex items-center gap-1.5 px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs rounded-lg transition-all duration-200 font-semibold shadow-sm hover:shadow-md">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Setujui
                                        </button>
                                        <button wire:click="rejectTransaction({{ $transaction->id }})" class="inline-flex items-center gap-1.5 px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs rounded-lg transition-all duration-200 font-semibold shadow-sm hover:shadow-md">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Tolak
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="px-6 py-12 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 mb-3">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-900 dark:text-gray-100 font-semibold">Semua donasi sudah diverifikasi</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Tidak ada donasi yang menunggu konfirmasi</p>
                        </div>
                        @endforelse
                    </div>

                    @if ($totalPending > 0)
                    <div class="px-6 py-3.5 bg-gray-50 dark:bg-gray-700/30 border-t border-gray-200 dark:border-gray-700">
                        <a href="/admin/transactions?status=pending" class="inline-flex items-center gap-1 text-blue-600 dark:text-blue-400 text-sm font-semibold hover:gap-2 transition-all duration-200">
                            Lihat semua donasi menunggu
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-6">
                <!-- Recent Donations -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-transparent dark:from-gray-700/50">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Donasi Terbaru</h2>
                    </div>
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($recentTransactions->take(4) as $transaction)
                        <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $transaction->nama_donatur }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ $transaction->program?->nama ?? 'General' }}</p>
                            <div class="flex justify-between items-center mt-3 pt-3 border-t border-gray-100 dark:border-gray-700">
                                <p class="text-xs text-gray-500 dark:text-gray-500">{{ $transaction->created_at->diffForHumans() }}</p>
                                <p class="font-semibold text-green-600 dark:text-green-400">Rp {{ number_format($transaction->jumlah, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="px-6 py-8 text-center text-gray-600 dark:text-gray-400 text-sm">
                            Belum ada donasi
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Data Summary -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl p-5 border border-blue-200 dark:border-blue-800/50 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                        </svg>
                        Ringkasan Data
                    </h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center pb-3 border-b border-blue-300 dark:border-blue-700/50">
                            <span class="text-gray-700 dark:text-gray-300">Total Donatur</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ collect($recentTransactions)->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-blue-300 dark:border-blue-700/50">
                            <span class="text-gray-700 dark:text-gray-300">Total Penerima Manfaat</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $totalMustahik }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-blue-300 dark:border-blue-700/50">
                            <span class="text-gray-700 dark:text-gray-300">Berita Dipublikasi</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $totalNews }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 dark:text-gray-300">Berita Draf</span>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $unpublishedNews }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Top Programs -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-transparent dark:from-gray-700/50">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Program Top Donasi</h2>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($topPrograms as $program)
                    <div class="px-6 py-5 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-900 dark:text-white truncate text-sm">{{ $program->nama }}</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1.5">
                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ $program->transactions_count }}</span> donasi terhimpun
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900 dark:text-white text-sm">Rp {{ number_format($program->transactions_sum_jumlah ?? 0, 0, ',', '.') }}</p>
                                <a href="/admin/programs/{{ $program->id }}" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold mt-2 inline-flex items-center gap-1 transition-colors">
                                    Kelola
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center text-gray-600 dark:text-gray-400 text-sm">
                        Belum ada program aktif
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Payment Confirmations -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 to-transparent dark:from-gray-700/50">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Bukti Transfer Terbaru</h2>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($pendingPaymentConfirmations as $confirmation)
                    <div class="px-6 py-5 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-150">
                        <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ $confirmation->transaction->nama_donatur }}</p>
                        <div class="mt-3 space-y-2 text-xs text-gray-600 dark:text-gray-400">
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-500">Bank Pengirim:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $confirmation->bank_pengirim }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-500">Nominal:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100">Rp {{ number_format($confirmation->jumlah_transfer, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-500">Tanggal:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $confirmation->tanggal_transfer }}</span>
                            </div>
                        </div>
                        <a href="/admin/payment-confirmations/{{ $confirmation->id }}" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold mt-3 inline-flex items-center gap-1 transition-colors">
                            Verifikasi
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center text-gray-600 dark:text-gray-400 text-sm">
                        Tidak ada bukti transfer pending
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Qurban Section -->
        @if (!empty($qurbanStats))
        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-xl shadow-sm border border-emerald-200 dark:border-emerald-800/50 p-6 overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <span class="text-2xl">🐑</span>
                        Program Qurban - {{ $qurbanStats['period_name'] }}
                    </h2>
                </div>
                <a href="/admin/qurban" class="inline-flex items-center gap-1 text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 text-sm font-semibold transition-colors">
                    Kelola Qurban
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-emerald-200 dark:border-emerald-800/30">
                    <p class="text-xs font-semibold text-emerald-700 dark:text-emerald-400 uppercase tracking-wide">Total Registrasi</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $qurbanStats['total_registrations'] }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-emerald-200 dark:border-emerald-800/30">
                    <p class="text-xs font-semibold text-emerald-700 dark:text-emerald-400 uppercase tracking-wide">Dikonfirmasi</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $qurbanStats['confirmed_registrations'] }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-emerald-200 dark:border-emerald-800/30">
                    <p class="text-xs font-semibold text-emerald-700 dark:text-emerald-400 uppercase tracking-wide">Progres Konfirmasi</p>
                    <div class="mt-3">
                        @php
                        $progress = $qurbanStats['total_registrations'] > 0 ? round(($qurbanStats['confirmed_registrations'] / $qurbanStats['total_registrations']) * 100) : 0;
                        @endphp
                        <div class="relative h-2.5 bg-emerald-200 dark:bg-emerald-900/30 rounded-full overflow-hidden">
                            <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-emerald-500 to-teal-500 dark:from-emerald-400 dark:to-teal-400 transition-all duration-500" style="width: {{ $progress }}%"></div>
                        </div>
                        <p class="text-sm font-bold text-emerald-700 dark:text-emerald-400 mt-2">{{ $progress }}%</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-emerald-200 dark:border-emerald-800/30">
                    <p class="text-xs font-semibold text-emerald-700 dark:text-emerald-400 uppercase tracking-wide">Dana Terkumpul</p>
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-2">Rp {{ number_format($qurbanStats['total_amount'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>