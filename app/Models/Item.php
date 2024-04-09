<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function setStatus(StatusEnum $status): void
    {
        $this->attributes['status'] = $status->value;
    }

    public function getStatus(): StatusEnum
    {
        return StatusEnum::from($this->attributes['status']);
    }
}
