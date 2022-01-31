<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Ambassador;

class Division extends Model
{

    use SoftDeletes;
    protected $table = 'divisions';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'name' ,
        'id_parent' , 
        'level' , 
        'collaborators' , 
        'id_ambassador' , 
    ];

    protected $dates = ['deleted_at'];

    public function children(){
        return $this->hasMany(self::class , 'id_parent');
    }

    public function parent(){
        return $this->belongsTo(self::class , 'id_parent');
    }

    public function ambassador(){
        return $this->belongsTo(Ambassador::class , 'id_ambassador');
    }
}
