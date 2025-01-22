<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryRedeem;

class HistoryRedeemController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $historyRedeems = HistoryRedeem::where('user_id', $user->id)
                                    ->with('item')
                                    ->paginate(5);

        return view('history.index', compact('historyRedeems'));
        // $historyRedeems = HistoryRedeem::where('user_id', auth()->id())->get();

        // return view('history.index', compact('historyRedeems'));
    }


}
