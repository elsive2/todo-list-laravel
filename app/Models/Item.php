<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 * @property string $status
 * @property string $description
 * @property int $user_id
 */
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

    public function setStatus(StatusEnum $status): self
    {
        $this->attributes['status'] = $status->value;

        return $this;
    }

    public function getStatus(): StatusEnum
    {
        return StatusEnum::from($this->attributes['status']);
    }
}
