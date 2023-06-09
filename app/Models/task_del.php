<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task_del extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function task()
    {
        return $this->belongsTo(Task::class,'task_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'participant_id');
    }
}
