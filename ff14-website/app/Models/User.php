<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'birthday',
        'profile_photo',
        'about_me',
        'is_admin',
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
            'birthday' => 'date',
            'is_admin' => 'boolean',
        ];
    }

    // nieuws van deze gebruiker
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    // comments made by this user
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // wall posts on this user's profile
    public function profilePosts(): HasMany
    {
        return $this->hasMany(ProfilePost::class, 'profile_user_id')->latest();
    }

    // messages received
    public function receivedMessages(): HasMany
    {
        return $this->hasMany(PrivateMessage::class, 'receiver_id')->latest();
    }

    // messages sent
    public function sentMessages(): HasMany
    {
        return $this->hasMany(PrivateMessage::class, 'sender_id')->latest();
    }

    // check of gebruiker admin is
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }
}
