<?php

namespace App\Filament\Resources\MsgraphMessages\Pages;

use App\Filament\Resources\MsgraphMessages\MsgraphMessageResource;
use Evitenic\RobustaTable\Concerns\HasRobustaTable;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;

class ManageMsgraphMessages extends ManageRecords
{
    use HasRobustaTable;

    protected static string $resource = MsgraphMessageResource::class;

    protected function paginateTableQuery(Builder $query): Paginator|CursorPaginator
    {
        return $query->fastPaginate(
            perPage: ($this->getTableRecordsPerPage() === 'all') ? $query->count() : $this->getTableRecordsPerPage(),
            columns: ['*'],
            pageName: $this->getTablePaginationPageName(),
        );
    }
}
