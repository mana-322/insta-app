<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'introduction', 
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
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

    #To get all the posts of a user
    public function posts(){
        return $this->hasMany(Post::class)->latest();
    }

    #To get all the followers of a user
    public function followers(){
        return $this->hasMany(Follow::class, 'following_id');
    }
    
    #To get all the users that the user is following
    public function following(){
        return $this->hasMany(Follow::class, 'follower_id');
    }

    #returens TRUE if the AUTH USER already
    public function isFollowed(){
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
    }

<<<<<<< HEAD
    public function stories(): HasMany
    {
        return $this->hasMany(Story::class);
    }

    public function hasActiveStories()
    {
        return $this->stories()->active()->exists();
=======
    #To get all messages sent by the user
    public function sentMessages(){
        return $this->hasMany(Message::class, 'sender_id');
    }

    #To get all messages received by the user
    public function receivedMessages(){
        return $this->hasMany(Message::class, 'receiver_id');
>>>>>>> 4c3d2b23c631712003dafcf9c8d5beede7a41b46
    }

}
