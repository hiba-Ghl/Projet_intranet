<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'IDUtilisateur';
    protected $fillable = ['Nom', 'Email', 'MotDePasse', 'Role', 'DateInscription'];

    public function forums()
    {
        return $this->hasMany(Forum::class, 'adminModerateur');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'auteur');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'UtilisateurDestinataire');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'auteur');
    }
}
