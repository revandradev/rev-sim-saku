<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements HasAvatar
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
        'email_verified_at',
        'role',
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
            'password'          => 'hashed',
        ];
    }

    /**
     * Cek apakah user adalah admin.
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin' ? true : false;
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function getFilamentAvatarUrl(): ?string
    {
                                   // Ambil relasi profil user
        $profile = $this->profile; // pastikan relasi profile() sudah ada di User model
                                   // Jika ada foto profil, ambil url-nya
        if ($profile && $profile->profile_photo) {
            return Storage::url($profile->profile_photo);
        }
        // Jika tidak ada, fallback ke avatar default
        return null;
    }
}
