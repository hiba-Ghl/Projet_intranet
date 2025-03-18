<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $table = 'forums';
    protected $primaryKey = 'IDforum';
    protected $fillable = ['nom', 'description', 'adminModerateur'];

    public function administrateur()
    {
        return $this->belongsTo(Utilisateur::class, 'adminModerateur');
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'IDforum');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'IDforum');
    }
}
