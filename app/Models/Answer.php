<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit jika nama tabel tidak mengikuti konvensi Laravel
    protected $table = 'answers';

    // Menentukan atribut yang dapat diisi secara massal
    protected $fillable = [
        'question_id',
        'answer_text',
        'is_correct',
        'created_at',
        'updated_at'
    ];

    /**
     * Mendefinisikan relasi dengan model `Question`
     * Satu jawaban hanya dimiliki oleh satu pertanyaan
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
