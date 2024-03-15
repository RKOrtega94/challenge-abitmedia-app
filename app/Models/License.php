<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "license_key",
        "platform",
        "status",
    ];

    function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected function generateSerial(): string
    {
        return bin2hex(random_bytes(50));
    }

    protected static function booted()
    {
        static::creating(function ($license) {
            $license->serial = $license->generateSerial();
            $license->status = $license->status ?? "active";
        });
    }
}
