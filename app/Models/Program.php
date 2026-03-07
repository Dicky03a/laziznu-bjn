<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'nama',
        'slug',
        'deskripsi',
        'konten',
        'thumbnail',
        'target_dana',
        'is_active',
        'is_featured',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'target_dana' => 'integer',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function confirmedTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class)->where('status', 'confirmed');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function scopeOfType(Builder $query, string $type): void
    {
        $query->where('type', $type);
    }

    public function getTotalTerkumpulAttribute(): int
    {
        if ($this->relationLoaded('confirmedTransactions')) {
            return $this->confirmedTransactions->sum('jumlah');
        }

        return $this->confirmedTransactions()->sum('jumlah');
    }

    public function getTotalDonaturAttribute(): int
    {
        if ($this->relationLoaded('confirmedTransactions')) {
            return $this->confirmedTransactions->count();
        }

        return $this->confirmedTransactions()->count();
    }

    public function getProgressPersenAttribute(): float
    {
        if (! $this->target_dana || $this->target_dana === 0) {
            return 0;
        }

        return min(100, round(($this->total_terkumpul / $this->target_dana) * 100, 1));
    }

    public function getIsOpenAttribute(): bool
    {
        if (! $this->is_active) {
            return false;
        }

        if ($this->end_date && $this->end_date->isPast()) {
            return false;
        }

        return true;
    }

    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail
            ? asset('storage/' . $this->thumbnail)
            : asset('images/default-program.jpg');
    }

    public static function generateSlug(string $nama): string
    {
        $slug = Str::slug($nama);
        $count = static::where('slug', 'like', $slug . '%')->count();

        return $count > 0 ? $slug . '-' . ($count + 1) : $slug;
    }
}
