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

        // Periksa apakah item sudah diredeem
        if ($inventory->redeemed) {
            return redirect()->route('dashboard')->with('error', 'Item ini sudah diredeem sebelumnya.');
        }

        // Tandai item sebagai diredeem
        $inventory->update(['redeemed' => true]);

        // Simpan ke history redeem
        HistoryRedeem::create([
            'user_id' => $inventory->user_id,
            'item_id' => $inventory->item_id,
            // Tambahkan field lain jika diperlukan, seperti 'redeemed_at'
        ]);

        // Set flash message
        session()->flash('success', 'Item berhasil diredeem!');

        // Redirect atau kirim respon
        return redirect()->route('dashboard')->with('success', 'Item berhasil di-redeem dan masuk ke history.');
    }
}
