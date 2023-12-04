<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;


class Department extends Model
{
    use HasFactory;

    public function students(): HasManyThrough
    {
        return $this->hasManyThrough(
            Student::class,
            Lecturer::class,
            'department_id',
            'nidn',
            'id',
            'nidn'
        );
    }

    public function student(): HasOneThrough
    {
        return $this->hasOneThrough(
            Student::class,
            Lecturer::class,
            'department_id',
            'nidn',
            'id',
            'nidn'
        );
    }
}
