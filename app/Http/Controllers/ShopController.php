<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\HistoryRedeem;

class ShopController extends Controller
{
    public function index()
    {
        // Fetch items with pagination
        $items = Item::paginate(9);
        return view('shop.index', compact('items'));
    }

    public function buy(Request $request, $id)
{
    $user = auth()->user();
    $item = Item::findOrFail($id);

    // Validasi nomor telepon
    $request->validate([
        'phone_number' => 'required|regex:/^08\d{8,11}$/'
    ]);

    $phoneNumber = $request->input('phone_number');

    if ($item->quantity < 1) {
        return response()->json(['success' => false, 'message' => 'Item ini sudah habis.']);
    }

    if ($user->points >= $item->price) {
        $user->points -= $item->price;
        $user->save();

        Inventory::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);

        $item->quantity -= 1;
        $item->save();

        // Simpan data ke history_redeems
        HistoryRedeem::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'phone_number' => $phoneNumber
        ]);

        return response()->json(['success' => true, 'message' => 'Item berhasil dibeli dan nomor telepon disimpan.']);
    } else {
        return response()->json(['success' => false, 'message' => 'Poin Anda tidak mencukupi untuk membeli item ini.']);
    }
}

        public function redeem($id)
    {
        $user = auth()->user();
        $inventory = Inventory::where('user_id', $user->id)->where('id', $id)->firstOrFail();

        // Logika untuk meredeem item
        $inventory->redeemed = true;
        $inventory->save();

        return redirect()->back()->with('success', 'Item successfully redeemed!');
    }
    public function fetchItems(Request $request)
    {
        if ($request->ajax()) {
            $items = Item::paginate(9);
            return view('shop.partials.items', compact('items'))->render();
        }
        return redirect()->route('shop.index');
    }
}
