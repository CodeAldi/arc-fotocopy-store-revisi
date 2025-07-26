<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderJasaDetails extends Model
{
    use HasFactory;
    protected $table = 'order_jasa_details';
    protected $guarded = ['id'];

    /**
     * Get the order that owns the OrderJasaDetails
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    /**
     * Get the jasa that owns the OrderJasaDetails
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jasa(): BelongsTo
    {
        return $this->belongsTo(Jasa::class, 'jasa_id');
    }
}
