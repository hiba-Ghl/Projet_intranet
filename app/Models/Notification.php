<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'IDnotification';
    protected $fillable = ['message', 'dateEnvoi', 'UtilisateurDestinataire', 'Lue'];

    public function destinataire()
    {
        return $this->belongsTo(Utilisateur::class, 'UtilisateurDestinataire');
    }
}
