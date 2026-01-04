<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'module',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'enrollments')->withPivot('status', 'grade', 'enrolled_at', 'completed_at');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'module_teachers');
    }
}
