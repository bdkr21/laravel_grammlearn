<?php

namespace App\Http\Controllers;
use App\Models\Inventory;
use App\Models\HistoryRedeem;
use Illuminate\Http\Request;

class InventoryController extends Controller
    {
    //
    public function redeemItem($inventoryId)
    {
        // Cari inventory berdasarkan ID
        $inventory = Inventory::findOrFail($inventoryId);

        // Simpan ke history redeem
        HistoryRedeem::create([
            'user_id' => $inventory->user_id,
            'item_id' => $inventory->item_id,
            // Kamu bisa menambahkan field lain yang diperlukan, seperti 'redeemed_at'
        ]);

        // Set flash message
        session()->flash('success', 'Item berhasil diredeem!');

        // Hapus item dari inventory
        $inventory->delete();

        // Redirect atau kirim respon
        return redirect()->route('dashboard')->with('success', 'Item berhasil di-redeem dan masuk ke history.');
    }
}
