<?php

namespace App\Models;
use App\Models\Societe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded=[];

    public function Societe()
    {
        return $this->belongsTo(Societe::class) ;
    }

    public function project()
    {
        return $this->hasMany(Project::class) ;
    }
}
