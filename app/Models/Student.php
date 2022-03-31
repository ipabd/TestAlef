<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email','classst_id'
    ];

    public function classst()
    {
        return $this->belongsTo(Classst::class);
    }

}
