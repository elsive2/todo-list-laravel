<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setStatus(StatusEnum $status): void
    {
        $this->attributes['status'] = $status->value;
    }

    public function getStatus(): StatusEnum
    {
        return StatusEnum::from($this->attributes['status']);
    }
}
