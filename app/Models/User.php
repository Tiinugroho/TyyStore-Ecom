<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\tbpesanan;
use App\Models\tbcheckout;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $table = ['users'];
    protected $fillable = [
        'username',
        'email',
        'password',
        'phone',
        'address',
        'role_id',
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

    public function pesanan(): HasMany
    {
        return $this->hasMany(tbpesanan::class, 'id_user', 'id');
    }
    public function role(): HasMany
    {
        return $this->hasMany(Role::class, 'role_id', 'id');
    }
    protected $attributes = [
        'role_id'=> 2,
    ];

}
