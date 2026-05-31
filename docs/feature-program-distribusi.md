# Feature Program Distribusi Dana

## Tujuan

Menambahkan fitur Program Distribusi yang terpisah dari Program Pengumpulan Dana.
Program Distribusi digunakan untuk merencanakan dan menyalurkan dana dari program pengumpulan ke tujuan distribusi.

## Entitas Baru

### DistributionProgram

Tabel `distribution_programs` menyimpan:

- `source_program_id` (sumber dana dari tabel `programs`)
- `nama`
- `slug`
- `deskripsi`
- `konten`
- `thumbnail`
- `target_dana`
- `is_active`
- `start_date`
- `end_date`
- timestamps
- soft deletes

## Relasi

- `DistributionProgram` belongsTo `Program` sebagai `sourceProgram`
- `Program` hasMany `DistributionProgram` sebagai `distributions`

## Alur

1. Admin membuat program distribusi.
2. Admin memilih sumber program pengumpulan dana aktif.
3. Sistem menolak target distribusi jika melebihi sisa dana yang tersedia dari sumber.
4. Program distribusi tampil di halaman publik `Program` di bawah bagian program pengumpulan.

## Tampilan Publik

Halaman `resources/views/pages/public/program.blade.php` menampilkan:

- Program donasi/infaq yang ada sekarang
- Section baru `Program Distribusi` dengan daftar distribusi aktif

## Admin

Admin memiliki halaman baru:

- `distribution-programs.index`
- `distribution-programs.create`
- `distribution-programs.edit`

Menu admin juga memuat tautan ke `Program Distribusi`.

## Validasi Bisnis

- Sumber harus berasal dari `programs` dengan `type` `infaq`, `donasi`, atau `zakat`
- `target_dana` minimal `1000`
- `target_dana` tidak boleh melebihi sisa dana tersedia dari sumber

## Notes

Langkah berikutnya jika ingin pengembangan lanjutan:

- tambahkan halaman detail publik untuk tiap `DistributionProgram`
- buat tabel transaksi distribusi terpisah jika perlu pencatatan realisasi dana
