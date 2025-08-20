<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class MsgraphAttachment extends Model
{
    use HasUuids;

    protected $connection = 'crm-dev';

    protected $keyType = 'string';
}
