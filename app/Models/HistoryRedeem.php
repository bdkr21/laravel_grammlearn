<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryRedeem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',   // Pastikan 'user_id' ada di sini
        'item_id',   // Field lain yang juga perlu diisi
        'phone_number',   // Field lain yang juga perlu diisi
        // Tambahkan field lain sesuai kebutuhan, misalnya 'redeemed_at'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
