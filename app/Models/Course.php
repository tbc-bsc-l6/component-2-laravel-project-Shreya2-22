<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'enrollments')->withPivot('enrollment_date', 'pass_fail', 'completion_date');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}