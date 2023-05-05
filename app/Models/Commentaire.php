<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'commentaires';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];


    /**
     * Get the tache that the commentaire belongs to.
     */
 

    /**
     * Get the user that owns the commentaire.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function task(){
        return $this->belongsTo(Task::class,'tache_id');
    }
    
}

