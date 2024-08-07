<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'title',
        'description',
    ];


    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
