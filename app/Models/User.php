<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Traits\IsFilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory, IsFilamentUser, Notifiable;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function gravatar() : Attribute
    {
        return Attribute::make(
            fn () => 'https://www.gravatar.com/avatar/' . md5($this->email)
        )->shouldCache();
    }

    public function renderedDescription() : Attribute
    {
        return Attribute::make(
            fn () => Str::markdown($this->description ?? '')
        )->shouldCache();
    }

    public function githubUrl() : Attribute
    {
        return Attribute::make(
            fn () => 'https://github.com/' . $this->github_handle
        );
    }

    public function twitterUrl() : Attribute
    {
        return Attribute::make(
            fn () => 'https://twitter.com/' . $this->twitter_handle
        );
    }
}
