<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $primaryKey = 'IDmessage';
    protected $fillable = ['contenu', 'dateEnvoi', 'auteur', 'IDdiscussion'];

    public function auteur()
    {
        return $this->belongsTo(Utilisateur::class, 'auteur');
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class, 'IDdiscussion');
    }
}

