<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Item;

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

        // Cek apakah quantity item cukup
        if ($item->quantity < 1) {
            return redirect()->back()->with('error', 'This item is out of stock.');
        }

        // Cek apakah user memiliki poin yang cukup
        if ($user->points >= $item->price) {
            // Kurangi poin user
            $user->points -= $item->price;
            $user->save();

            // Simpan item ke inventory user
            Inventory::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);

            // Kurangi quantity item
            $item->quantity -= 1;
            $item->save();

            return redirect()->back()->with('success', 'Item successfully purchased and added to your inventory!');
        } else {
            return redirect()->back()->with('error', 'You do not have enough points to purchase this item.');
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
