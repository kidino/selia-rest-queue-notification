<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomPasswordResetNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
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

    protected static function booted()
    {
        static::created(function(){
            Cache::forget('total_users');            
        });

        
        static::deleted(fn () => Cache::forget('total_users'));
    }


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

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole( $role ) {
        return $this->roles->pluck('name')->contains($role);
    }

    public function notes() {
        return $this->hasMany( Note::class );
    }

    public function plainToken() {
        return $this->hasMany( PlainToken::class );
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new CustomPasswordResetNotification($token));   
    }

    public function routeNotificationForTwilio(): ?string
    {
        return $this->phone ? str_replace(' ', '', $this->phone) : null;
    }

}
