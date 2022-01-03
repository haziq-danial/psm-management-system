<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'std_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'matric_no',
        'course',
        'faculty',
        'sem_year',
        'campus',
    ];

    public function detail()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function title()
    {
        return $this->hasOne(Title::class, 'std_id','std_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'std_id', 'std_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'sv_id', 'sv_id');
    }

}
