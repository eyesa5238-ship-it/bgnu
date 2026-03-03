<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicPosition extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'institute',
        'from_date',
        'to_date',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
