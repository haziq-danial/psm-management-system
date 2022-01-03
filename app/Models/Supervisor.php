<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    protected $primaryKey = 'sv_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'staff_id',
        'faculty',
        'expertise',
        'office_no'
    ];

    public function detail()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function titles()
    {
        return $this->hasMany(Title::class,'sv_id');
    }
}
