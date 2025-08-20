<?php

namespace App\Filament\Resources\MsgraphMessages;

use App\Filament\Resources\MsgraphMessages\Pages\ManageMsgraphMessages;
use App\Filament\Resources\MsgraphMessages\Pages\ViewMsgraphMessage;
use App\Models\MsgraphMessage;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MsgraphMessageResource extends Resource
{
    protected static ?string $model = MsgraphMessage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $recordTitleAttribute = 'subject';

    protected static ?int $navigationSort = 1;

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->select('id', 'subject');
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return self::getUrl() . '?' . urldecode(http_build_query(['tableFilters' => ['subject' => ['subject' => $record->subject]]]));
    }

    public static function getNavigationLabel(): string
    {
        return 'Mail';
    }

    public static function getLabel(): string
    {
        return 'Mail';
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->headerActions([
                        Action::make('detail')
                            ->url(fn($record) => static::getUrl('detail', ['record' => $record]))
                    ])
                    ->schema([
                        TextEntry::make('subject'),
                        TextEntry::make('from_name'),
                        TextEntry::make('from_email_address'),
                        TextEntry::make('handleBy.name')
                            ->label('Handle by'),
                        TextEntry::make('recipients.address')
                            ->label('Recipients')
                            ->badge()
                    ])
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('subject')
            ->reorderableColumns()
            ->deferColumnManager(false)
            ->columns([
                IconColumn::make('has_attachments')
                    ->label('')
                    ->boolean(),
                TextColumn::make('subject')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('from_name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('from_email_address')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('received_date_time')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('handleBy.name')
                    ->label('Handle by')
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()
                    ->slideOver()
            ])
            ->toolbarActions([
                //
            ])
            ->resizeableColumns([
                'minColumnWidth' => 50,
                'maxColumnWidth' => -1,
            ])
            ->excludedResizeableColumns(['has_attachments']);
        // ->excludeReorderColumns(['has_attachments']);
        // ->persistsToggledColumns()
        // ->persistsReorderedColumns();
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageMsgraphMessages::route('/'),
            'detail' => ViewMsgraphMessage::route('/{record}')
        ];
    }
}
