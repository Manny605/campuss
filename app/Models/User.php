<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'nom', 'prenom', 'telephone',
        'identifiant',
        'password', 'statut'
    ];






    // Relations

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function permissions()
    {
        return $this->roles->map->permissions->flatten()->unique('id');
    }

    public function etudiant()
    {
        return $this->hasOne(Etudiant::class, 'id');
    }

    public function parent()
    {
        return $this->hasOne(ParentTuteur::class, 'id');
    }







    

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
}
