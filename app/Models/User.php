<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'IDUtilisateur';
    protected $fillable = [
        'nom',
        'email',
        'mot_de_passe',
        'role',
        'date_inscription',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    /**
     * Get the name of the password field.
     *
     * @return string
     */
    public function getPasswordName()
    {
        return 'password';
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getPasswordAttribute()
    {
        return $this->mot_de_passe;
    }
}
