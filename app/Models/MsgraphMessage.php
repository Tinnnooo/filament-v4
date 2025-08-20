<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MsgraphMessage extends Model
{
    use HasUuids;

    protected $connection = 'crm-dev';

    protected $keyType = 'string';

    public function attachments(): HasMany
    {
        return $this->hasMany(MsgraphAttachment::class);
    }
}
