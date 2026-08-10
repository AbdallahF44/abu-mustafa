<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    protected $fillable = [
        'name',
        'national_id',
        'phone',
        'is_elected',
        'note',
    ];

    protected $casts = [
        'is_elected' => 'boolean',
    ];
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}