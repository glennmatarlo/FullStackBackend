<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subj_title',
        'instructor',
        'user_id',
    ];

    public function container() {
        return $this->belongsTo('App\Models\Subject', 'instructor', 'id');
    }
}
