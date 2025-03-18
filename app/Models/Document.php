<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $primaryKey = 'IDdocument';
    protected $fillable = ['titre', 'dateUpload', 'auteur', 'IDforum', 'cheminFichier'];

    public function auteur()
    {
        return $this->belongsTo(Utilisateur::class, 'auteur');
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'IDforum');
    }
}
