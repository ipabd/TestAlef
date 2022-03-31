<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classst extends Model
{
   use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function lecture() {
        return $this->belongsToMany(Lecture::class,'plans')->orderBy('parent');
    }

    public function saveStudent($student) {
        if(count($student)) {
            $student->toQuery()->update([
                'classst_id' => 0,
            ]);
        }
    }
}
