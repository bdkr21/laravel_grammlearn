<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAccessLog extends Model
{
    use HasFactory;

    // Nama tabel (jika berbeda dengan nama model)
    protected $table = 'course_access_logs';

    // Kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'course_id',
        'accessed_at',
        'action_type',
    ];

    // Menentukan tipe akses (opsional)
    const ACTION_VIEW = 'view';
    const ACTION_COMPLETE = 'complete';

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
