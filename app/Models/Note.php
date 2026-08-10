<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Note extends Model
{
    protected $fillable = [
        'person_id',
        'message',
        'status',
    ];

    protected $attributes = [
        'status' => 'new',
    ];

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}