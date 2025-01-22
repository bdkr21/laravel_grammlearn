<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Item;
use App\Models\Quiz;
use App\Models\Course;
use App\Models\Question;
use App\Models\Inventory;
use App\Models\HistoryRedeem;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $role = $user->role;
        $users = User::all(); // Ambil semua user untuk ditampilkan di dashboard
        $points = Auth::user()->points;
        $items = Item::paginate(10);
        $materis = Course::paginate(10);
        $quizzes = Question::all();
        $inventories = Inventory::with(['item', 'user'])
        ->where('redeemed', false) // Tambahkan filter di sini
        ->paginate(5); // Paginasi tetap diterapkan

        return view('dashboard', compact('points', 'role', 'users', 'items', 'materis', 'quizzes','inventories'));
    }

    public function create(): View
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role ?? 'user',
        ]);

        return redirect()->route('dashboard')->with('success', 'User created successfully.');
    }

    public function edit(string $id): View
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role ?? $user->role,
        ]);

        return redirect()->route('dashboard')->with('success', 'User updated successfully.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'User deleted successfully.');
    }

    public function getItems(Request $request)
    {
        $items = Item::paginate(10); // Ambil data dengan pagination
        return view('components.admin.items-table', compact('items'));

        // if ($request->ajax()) {
        //     $items = Item::paginate(10); // Assuming you use pagination
        //     return view('components.admin.items-table', compact('items'))->render();
        // }
        // return redirect()->route('dashboard');
    }
    public function getUsers(Request $request)
    {
        $user_all = User::paginate(10); // Ambil data dengan pagination
        return view('components.admin.users-table', compact('user_all'));
    }

    public function getCourses(Request $request)
    {
        $materis = Course::paginate(10); // Ambil data dengan pagination
        return view('components.admin.materi-table', compact('materis'));
    }

    public function getQuiz(Request $request)
    {
        $quizs = Quiz::paginate(10); // Ambil data dengan pagination
        return view('components.admin.quizzes-table', compact('quizs'));
    }
}
