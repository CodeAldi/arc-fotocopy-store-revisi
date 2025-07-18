<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jasa extends Model
{
    use HasFactory;
    protected $table = 'jasa';
    protected $guarded = ['id'];

    /**
     * Get the kategori that owns the Jasa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriJasa::class, 'kategori_jasa_id');
    }
}
