<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Define the table name if it's not the default
    protected $table = 'messages';

    // Define the primary key (optional if it follows Laravel conventions)
    protected $primaryKey = 'IDmessage';

    // Define the fillable fields to mass-assign
    protected $fillable = ['contenu', 'dateEnvoi', 'auteur', 'IDdiscussion'];

    // Relationship to the Utilisateur (User) model (Ensure 'auteur' corresponds to a valid user ID)
    public function auteur()
    {
        return $this->belongsTo(Utilisateur::class, 'auteur');
    }

    // Relationship to the Discussion model
    public function discussion()
    {
        return $this->belongsTo(Discussion::class, 'IDdiscussion');
    }

    // Optional: If you're working with timestamps (created_at, updated_at)
    public $timestamps = true;
}
