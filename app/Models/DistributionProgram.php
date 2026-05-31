<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DistributionProgram extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'source_program_id',
        'nama',
        'slug',
        'deskripsi',
        'konten',
        'thumbnail',
        'target_dana',
        'is_active',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'target_dana' => 'integer',
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function sourceProgram(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'source_program_id')->withTrashed();
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail
              ? asset('storage/'.$this->thumbnail)
              : asset('images/default-program.jpg');
    }

    public static function generateSlug(string $nama): string
    {
        $slug = Str::slug($nama);
        $count = static::where('slug', 'like', $slug.'%')->count();

        return $count > 0 ? $slug.'-'.($count + 1) : $slug;
    }

    public function getProgressPersenAttribute(): float
    {
        if (! $this->target_dana || $this->target_dana === 0 || ! $this->sourceProgram) {
            return 0;
        }

        $totalTerkumpul = $this->sourceProgram->total_terkumpul;
        if (! $totalTerkumpul || $totalTerkumpul === 0) {
            return 0;
        }

        return min(100, round(($this->target_dana / $totalTerkumpul) * 100, 1));
    }

    public function getPersentaseFromSourceAttribute(): float
    {
        if (! $this->sourceProgram) {
            return 0;
        }

        $totalAllocated = $this->sourceProgram->total_distribusi_dialokasikan;
        if (! $totalAllocated || $totalAllocated === 0) {
            return 0;
        }

        return round(($this->target_dana / $totalAllocated) * 100, 1);
    }
}
