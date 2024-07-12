<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ShopController extends Controller
{
    public function index()
    {
        // Ambil semua item dari database
        $items = Item::all();
        return view('shop.index', compact('items'));
    }

    public function buy(Request $request, $id)
    {
        // Implementasi pembelian item menggunakan poin
        $user = auth()->user();
        $item = Item::findOrFail($id);

        if ($user->points >= $item->price) {
            $user->points -= $item->price;
            $user->save();

            return redirect()->back()->with('success', 'Item berhasil dibeli!');
        } else {
            return redirect()->back()->with('error', 'Poin Anda tidak mencukupi untuk membeli item ini.');
        }
    }
}
