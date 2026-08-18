<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Story extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'media', 'media_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('created_at', '>=', now()->subHours(24));
    }

    public function likes()
{
    return $this->hasMany(StoryLike::class);
}

    public function comments()
    {
        return $this->hasMany(StoryComment::class);
    }

    public function isLiked()
    {
        return $this->likes()->where('user_id', Auth::id())->exists();
    }

}
