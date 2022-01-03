<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $primaryKey = 'proposal_id';

    protected $fillable = [
        'objective',
        'scope_of_project',
        'problem_background',
        'techniques',
        'status_approval',
    ];

    public function title()
    {
        return $this->belongsTo(Title::class,'title_id','title_id');
    }
}
