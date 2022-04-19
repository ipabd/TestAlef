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
        return $this->hasmany(Student::class);
    }

    public function lecture()
    {
        return $this->belongsToMany(Lecture::class, 'plans')->withPivot(['id','parent'])
            ->orderBy('parent');
    }
}
