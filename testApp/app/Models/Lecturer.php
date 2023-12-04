<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lecturer extends Model
{
    use HasFactory;

    protected $primaryKey = 'nidn';

    protected $fillable = [
        'nidn',
        'nama',
        'department_id'
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'nidn', 'nidn');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
