<?php

namespace App\Filament\Resources\MsgraphMessages\Pages;

use App\Filament\Resources\MsgraphMessages\MsgraphMessageResource;
use Filament\Resources\Pages\ViewRecord;

class ViewMsgraphMessage extends ViewRecord
{
    protected static string $resource = MsgraphMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
