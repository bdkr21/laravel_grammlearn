<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;
use App\Models\HistoryRedeem;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'quantity',

    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
    public function historyRedeems()
    {
        return $this->hasMany(HistoryRedeem::class);
    }

}
