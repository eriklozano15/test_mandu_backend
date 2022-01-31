<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ambassador extends Model
{
    use SoftDeletes;
    protected $table = 'ambassadors';
    protected $primaryKey = 'id';

    protected $fillable = [ 
        'name' ,
    ];

    protected $dates = ['deleted_at'];
}
