<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function projet(){
        return $this->belongsTo(Project::class);
    }
    public function commentaire(){
        return $this->hasMany(Commentaire::class);
    }
    public function task_assignments(){
        return $this->hasMany(Task_assignment::class);
    }

}
