<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    public $fillable = ['name', 'status', 'order','school_id'];


    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
