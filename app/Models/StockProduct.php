<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "windows_stock",
        "mac_stock",
    ];

    function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
