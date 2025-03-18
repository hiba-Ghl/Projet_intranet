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

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'IDforum');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'IDdiscussion');
    }
}
