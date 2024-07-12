<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    public function givePoints(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->input('course_id');

        if (!$user || !$courseId) {
            return response()->json(['success' => false, 'message' => 'Invalid request'], 400);
        }

        $user->points += 10;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Points added successfully']);
    }
}
