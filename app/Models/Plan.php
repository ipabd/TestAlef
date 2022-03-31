<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'lecture_id',  ///лекция
        'classst_id', ///класс
        'parent',  //порядок лекции
    ];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}
