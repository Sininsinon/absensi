<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Kategori;
use App\Models\Devisi;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'category_id',
        'institution',
        'division_id',
        'profile_picture',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function kategori()
{
    return $this->belongsTo(Kategori::class, 'category_id');
}
    public function Devisi()
{
    return $this->belongsTo(Devisi::class, 'division_id');
}

public function attendances()
{
    return $this->hasMany(Attendance::class);
}

}