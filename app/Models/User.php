<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Inventory;
use App\Models\HistoryRedeem;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
         'points',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'role',
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
    public function historyRedeems()
    {
        return $this->hasMany(HistoryRedeem::class);
    }

    /**
     * The categories that belong to the user.
     */
    // public function categories(): BelongsToMany
    // {
    //     return $this->belongsToMany(Category::class, 'user_categories')->withTimestamps();
    // }

    /**
     * The unlocked categories that belong to the user.
     */
    // public function unlockedCategories()
    // {
    //     return $this->belongsToMany(Category::class, 'user_unlocked_categories', 'user_id', 'category_id');
    //     // return $this->belongsToMany(Course::class, 'user_unlocked_courses', 'user_id', 'course_id');

    // }
}
