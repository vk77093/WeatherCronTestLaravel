<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatModel extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'longitude',
    //     'latitude',
    //     'timezone',
    //     'timezone_offset',
    // ];
    protected $guarded = ['id'];
}
