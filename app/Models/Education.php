<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'degree_name',
        'user_id',
        'status',
        'degree_level',
        'passing_year',
        'institute_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
