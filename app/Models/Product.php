<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "sku",
        "name",
        "description",
        "windows_price",
        "mac_price",
    ];

    public function stock()
    {
        return $this->hasOne(StockProduct::class);
    }
}
