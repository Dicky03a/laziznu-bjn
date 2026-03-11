<?php

// Admin Controllers
use App\Http\Controllers\Admin\DokumenController as AdminDokumenController;
use App\Http\Controllers\Admin\ExportReportController;
use App\Http\Controllers\Admin\LaporanBulananController as AdminLaporanBulananController;
use App\Http\Controllers\Admin\LaporanMwcController as AdminLaporanMwcController;
use App\Http\Controllers\Admin\LaporanTahunanController;
use App\Http\Controllers\Admin\MustahikController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\PetaSebaranController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\QurbanHewanController;
use App\Http\Controllers\Admin\QurbanPeriodController;
use App\Http\Controllers\Admin\QurbanRegistrationController;
use App\Http\Controllers\Admin\RekeningController as AdminRekeningController;
use App\Http\Controllers\Admin\SettingControllerProgram;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Public\DonasiController;
// Public Controllers
use App\Http\Controllers\Public\FidyahController;
use App\Http\Controllers\Public\InfaqController;
use App\Http\Controllers\Public\PaymentController;
use App\Http\Controllers\Public\PublicController as PublicPublicController;
use App\Http\Controllers\Public\QurbanController;
use App\Http\Controllers\Public\QurbanPaymentController;
use App\Http\Controllers\Public\ZakatController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::controller(PublicPublicController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/profile', 'profile')->name('profile');
    Route::get('/pengurus-laziznu-bojonegoro', 'pengurus')->name('pengurus-laziznu-bojonegoro');
    Route::get('/rekening-lengkap', 'rekening')->name('rekening-lengkap');
    Route::get('/dokumen', 'dokumen')->name('dokumen');
    Route::get('/program', 'program')->name('program');
    Route::get('/laporan/bulanan', 'laporanbulanan')->name('laporan-bulanan.public');
    Route::get('/laporan/tahunan', 'laporantahunan')->name('laporan-tahunan.public');
    Route::get('/status-mwc-ranting', 'statusmwcranting')->name('status-mwc-ranting');
    Route::get('/kalkulator-zakat', 'kalkulatorzakat')->name('kalkulator-zakat');
    Route::get('/kebijakan-privasi', 'privasi')->name('kebijakan-privasi');
    Route::get('/terms-conditions', 'syarat')->name('terms-conditions');
    Route::get('/disclaimer', 'disclaimer')->name('disclaimer');
    Route::get('/berita', 'berita')->name('berita.public.index');
});

// News & Dokumen Routes
Route::get('/berita/{news:slug}', [AdminNewsController::class, 'show'])->name('berita.show');
Route::get('dokumens/{dokumen}/download', [AdminDokumenController::class, 'download'])->name('dokumens.download');

// Zakat Routes
Route::prefix('zakat')->name('zakat.')->group(function () {
    Route::get('/', [ZakatController::class, 'index'])->name('index');
    Route::post('/', [ZakatController::class, 'store'])->name('store');
    Route::get('/desa/{kecamatanId}', [ZakatController::class, 'getDesa'])->name('getDesa');
});

// Infaq Routes
Route::prefix('infaq')->name('infaq.')->group(function () {
    Route::get('/', [InfaqController::class, 'index'])->name('index');
    Route::get('/{slug}', [InfaqController::class, 'show'])->name('show');
    Route::post('/{slug}/bayar', [InfaqController::class, 'store'])->name('store');
});

// Donasi Routes
Route::prefix('donasi')->name('donasi.')->group(function () {
    Route::get('/', [DonasiController::class, 'index'])->name('index');
    Route::get('/{slug}', [DonasiController::class, 'show'])->name('show');
    Route::post('/{slug}/bayar', [DonasiController::class, 'store'])->name('store');
});

// Fidyah Routes
Route::prefix('fidyah')->name('fidyah.')->group(function () {
    Route::get('/', [FidyahController::class, 'index'])->name('index');
    Route::post('/bayar', [FidyahController::class, 'store'])->name('store');
});

// Payment Confirmation Routes
Route::prefix('pembayaran')->name('payment.')->group(function () {
    Route::get('/{kode}', [PaymentController::class, 'show'])->name('show');
    Route::post('/{kode}/konfirmasi', [PaymentController::class, 'confirm'])->name('confirm');
    Route::get('/{kode}/status', [PaymentController::class, 'status'])->name('status');
});

// Quraban Routes
Route::prefix('qurban')->name('qurban.')->group(function () {
    Route::get('/', [QurbanController::class, 'index'])->name('index');
    Route::get('/hewan/{hewan}', [QurbanController::class, 'show'])->name('show');
    Route::post('/hewan/{hewan}/daftar', [QurbanController::class, 'store'])->name('store');
    Route::get('/pembayaran/{kode}', [QurbanPaymentController::class, 'show'])->name('payment');
    Route::post('/pembayaran/{kode}/konfirmasi', [QurbanPaymentController::class, 'confirm'])->name('payment.confirm');
});

// Admin Routes 
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('dashboard', fn() => view('dashboard'))->name('dashboard');

    // Export Reports
    Route::get('laporan/export-dskl', [ExportReportController::class, 'exportDskl'])->name('laporan.export-dskl');
    Route::get('laporan/export-infaq-shodaqah', [ExportReportController::class, 'exportInfaqShodaqah'])->name('laporan.export-infaq-shodaqah');

    Route::resource('profiles', AdminProfileController::class);
    Route::resource('rekenings', AdminRekeningController::class);
    Route::resource('news', AdminNewsController::class)->except('show');
    Route::resource('dokumens', AdminDokumenController::class);

    // Program management
    Route::resource('programs', ProgramController::class);
    Route::patch('programs/{program}/toggle-active', [ProgramController::class, 'toggleActive'])
        ->name('programs.toggle-active');
    Route::get('program/settings', [SettingControllerProgram::class, 'index'])->name('program.edit');
    Route::put('settings/program', [SettingControllerProgram::class, 'update'])->name('program.settings');

    // Transaction management
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/export', [TransactionController::class, 'export'])->name('transactions.export');
    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::post('transactions/{transaction}/confirm', [TransactionController::class, 'confirm'])->name('transactions.confirm');
    Route::post('transactions/{transaction}/reject', [TransactionController::class, 'reject'])->name('transactions.reject');

    // Pengurus management
    Route::resource('pengurus', PengurusController::class)
        ->parameters(['pengurus' => 'pengurus']);
    Route::patch('pengurus/{pengurus}/toggle-status', [PengurusController::class, 'toggleStatus'])
        ->name('pengurus.toggle-status');
    Route::delete('pengurus/{pengurus}/foto', [PengurusController::class, 'destroyFoto'])
        ->name('pengurus.destroy-foto');

    // Qurban management
    Route::prefix('qurban')->name('qurban.')->group(function () {

        Route::resource('periods', QurbanPeriodController::class)->names('periods');
        Route::patch('periods/{period}/toggle-active', [QurbanPeriodController::class, 'toggleActive'])
            ->name('periods.toggle-active');

        Route::resource('binatang', QurbanHewanController::class)
            ->names('binatang')
            ->parameters(['binatang' => 'hewan']);

        Route::patch('hewan/{hewan}/toggle-active', [QurbanHewanController::class, 'toggleActive'])
            ->name('hewan.toggle-active');

        Route::get('registrations', [QurbanRegistrationController::class, 'index'])
            ->name('registrations.index');
        Route::get('registrations/export', [QurbanRegistrationController::class, 'export'])
            ->name('registrations.export');
        Route::get('registrations/{registration}', [QurbanRegistrationController::class, 'show'])
            ->name('registrations.show');
        Route::post('registrations/{registration}/confirm', [QurbanRegistrationController::class, 'confirm'])
            ->name('registrations.confirm');
        Route::post('registrations/{registration}/cancel', [QurbanRegistrationController::class, 'cancel'])
            ->name('registrations.cancel');
    });

    Route::resource('laporan-bulanan', AdminLaporanBulananController::class)
        ->parameters(['laporan-bulanan' => 'laporanBulanan']);

    Route::resource('laporan-mwc', AdminLaporanMwcController::class)
        ->parameters(['laporan-mwc' => 'laporanMwc']);

    Route::resource('laporan-tahunans', LaporanTahunanController::class)
        ->parameters(['laporan-tahunans' => 'laporanTahunan']);

    Route::prefix('peta-sebaran')->name('peta-sebaran.')->group(function () {
        Route::get('/', [PetaSebaranController::class, 'index'])->name('index');
        Route::get('/export', [PetaSebaranController::class, 'exportExcel'])->name('export');
        Route::get('/desa', [PetaSebaranController::class, 'getDesa'])->name('getDesa');
    });

    Route::resource('mustahiks', MustahikController::class);

    Route::get('/mustahiks/getDesa/{kecamatan_id}', [MustahikController::class, 'getDesa'])
        ->name('mustahiks.getDesa');

    Route::get('/mustahiks/filterByKategori/{kategori}', [MustahikController::class, 'filterByKategori'])
        ->name('mustahiks.filterByKategori');

    Route::get('/mustahiks/statistik', [MustahikController::class, 'statistik'])
        ->name('mustahiks.statistik');
});

require __DIR__ . '/settings.php';
