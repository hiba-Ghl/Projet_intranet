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

    protected $table = 'utilisateurs'; // Change `users` en `utilisateurs`
    protected $primaryKey = 'IDUtilisateur'; // Indique la clé primaire personnalisée
    protected $fillable = [
        'Nom',
        'Email',
        'Mot_de_passe',
        'Role',
        'DateInscription',
    ];

    protected $hidden = [
        'Mot_de_passe',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

     public function getAuthPassword()
     {
         return $this->Mot_de_passe; // Laravel s'attend à un champ `password`, on adapte
     }
}
