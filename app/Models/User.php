<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected function name(): Attribute
    {
            return Attribute::make(
                get:fn (string $value)=> ucwords($value),
                set:fn (string $value)=>'Mr. '.ucfirst($value),
            );
    }
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function url(): HasMany
    {
        return $this->hasMany(URL::class,'user_id');
    }
}
