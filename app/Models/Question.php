<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit jika nama tabel tidak mengikuti konvensi Laravel
    protected $table = 'questions';

    // Menentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'course_id',
        'question',
        'created_at',
        'updated_at'
    ];

    /**
     * Mendefinisikan relasi dengan model `Course`
     * Satu pertanyaan hanya dimiliki oleh satu kursus
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Mendefinisikan relasi dengan model `Answer`
     * Satu pertanyaan bisa memiliki banyak jawaban
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
