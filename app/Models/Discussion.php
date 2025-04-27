<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $table = 'discussions';
    protected $primaryKey = 'IDdiscussion';
    protected $fillable = ['titre', 'description', 'dateCreation', 'IDforum'];

    // Define relationship with the Forum model
    public function forum()
    {
        return $this->belongsTo(Forum::class, 'IDforum');
    }

    // Define relationship with the Message model
    public function messages()
    {
        return $this->hasMany(Message::class, 'IDdiscussion');
    }
    
    // Optionally, if you are dealing with created_at/updated_at timestamps
    public $timestamps = true;  // Laravel will handle this automatically, just ensuring it's there.
}
