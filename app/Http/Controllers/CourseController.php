<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseAccessLog;
// use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateMateriRequest;


class CourseController extends Controller
{
    private function generateSlug($string)
    {
        $slug = strtolower($string);
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // Remove all non-alphanumeric characters except spaces
        $slug = trim($slug); // Remove leading/trailing spaces
        $slug = preg_replace('/\s+/', '-', $slug); // Replace spaces with hyphens
        $slug = preg_replace('/-+/', '-', $slug); // Replace multiple hyphens with a single hyphen
        return $slug;
    }

    public function index()
    {
        $grammarTopics = Course::all()->groupBy('category');
        $userAccessLogs = [];

        if (auth()->check()) {
            $userAccessLogs = CourseAccessLog::where('user_id', auth()->id())->pluck('course_id')->toArray();
        }

        return view('courses.index', [
            'grammarTopics' => $grammarTopics,
            'userAccessLogs' => $userAccessLogs
        ]);
    }
    public function create()
    {
        return view('admin.materi.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string', // CKEditor content
        ]);

        // Generate slug from title
        $slug = $this->generateSlug($request->title);

        // Include slug in data to save
        $data = $request->only(['title', 'content']);
        $data['slug'] = $slug;

        // Save to the database
        Course::create($data);

        return redirect()->route('dashboard')->with('success', 'Course created successfully.');
    }


    public function show($id)
    {
        $course = Course::findOrFail($id); // Ambil kursus berdasarkan ID
        if (auth()->check()) {
            CourseAccessLog::firstOrCreate([
                'user_id' => auth()->id(),
                'course_id' => $course->id,
            ]);
        }

        return view('courses.show', compact('course')); // Kembalikan tampilan show dengan data kursus
    }

    public function edit(Course $materi)
    {
        return view('admin.materi.edit', compact('materi'));
    }

    public function update(UpdateMateriRequest $request, Course $materi)
    {
        // Validasi data yang masuk
        $validated = $request->validated();

        // Update data kursus berdasarkan input yang diterima dari form
        $materi->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'slug' => $validated['slug'],
        ]);

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Materi berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('dashboard')->with('success', 'Course deleted successfully.');
    }

    // public function storeAnswers(Request $request, $id, $latihan)
    // {
    //     $request->validate([
    //         'answers' => 'required|array',
    //     ]);
    //     $answers = new UserAnswer([
    //         'user_id' => auth()->id(),
    //         'course_id' => $id,
    //         'latihan' => $latihan,
    //         'answers' => $request->input('answers'),
    //     ]);

    //     $answers->save();

    //     return redirect()->route('courses.show', $id)->with('success', "Your answers for Latihan $latihan have been submitted.");
    // }
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
    public function index3()
    {
        return view('landing');
    }
}
