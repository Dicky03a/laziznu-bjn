<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokuemen extends Model
{
    protected $table = 'dokumens';

    protected $fillable = [
        'nama_dokumen',
        'deskripsi',
        'file',
        'ukuran_file',
        'jumlah_download',
    ];
}
