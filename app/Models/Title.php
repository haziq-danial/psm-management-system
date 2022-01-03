<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $primaryKey = 'title_id';

    protected $fillable = [
        'psm_title'
    ];


    public function supervisor()
    {
        return $this->belongsTo(User::class,'sv_id');
    }
    public function supervisor_detail()
    {
        return $this->belongsTo(Supervisor::class,'sv_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class,'std_id');
    }

    public function student_detail()
    {
        return $this->belongsTo(Student::class,'std_id');
    }

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'title_id', 'title_id');
    }
}
