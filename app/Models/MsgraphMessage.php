<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MsgraphMessage extends Model
{
    use HasUuids, HasFactory;

    // protected $connection = 'crm-dev';

    public $incrementing = false;

    protected $keyType = 'string';

    public function handleBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function recipients(): HasMany
    {
        return $this->hasMany(Recipient::class);
    }
}
