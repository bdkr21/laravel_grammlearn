<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // Purchase item using points
        $user = auth()->user();
        $item = Item::findOrFail($id);

        if ($user->points >= $item->price) {
            $user->points -= $item->price;
            $user->save();

            return redirect()->back()->with('success', 'Item successfully purchased!');
        } else {
            return redirect()->back()->with('error', 'You do not have enough points to purchase this item.');
        }
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
