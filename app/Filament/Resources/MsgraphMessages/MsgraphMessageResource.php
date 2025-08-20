<?php

namespace App\Filament\Resources\MsgraphMessages;

use App\Filament\Resources\MsgraphMessages\Pages\ManageMsgraphMessages;
use App\Models\MsgraphMessage;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
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
        return self::getUrl().'?'.urldecode(http_build_query(['tableFilters' => ['subject' => ['subject' => $record->subject]]]));
    }

    public static function getNavigationLabel(): string
    {
        return 'Mail';
    }

    public static function getLabel(): string
    {
        return 'Mail';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('msgraph_entity_id')
                    ->required(),
                RichEditor::make('body_content')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('body_content_type')
                    ->required(),
                TextInput::make('body_preview'),
                DateTimePicker::make('created_date_time')
                    ->required(),
                TextInput::make('from_email_address')
                    ->email()
                    ->required(),
                TextInput::make('from_name'),
                Toggle::make('has_attachments')
                    ->required(),
                TextInput::make('internet_message_id'),
                Toggle::make('is_draft'),
                Toggle::make('is_read')
                    ->required(),
                DateTimePicker::make('last_modified_date_time'),
                TextInput::make('parent_folder_id')
                    ->required(),
                DateTimePicker::make('received_date_time')
                    ->required(),
                TextInput::make('reply_to'),
                TextInput::make('sender'),
                DateTimePicker::make('sent_date_time')
                    ->required(),
                TextInput::make('subject')
                    ->required(),
                TextInput::make('web_link'),
                TextInput::make('conversation_id')
                    ->required(),
                TextInput::make('msgraph_conversation_id')
                    ->required(),
                TextInput::make('responsible_id'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $query->with('attachments');
            })
            ->recordTitleAttribute('name')
            ->reorderableColumns()
            ->deferColumnManager(false)
            ->columns([
                IconColumn::make('has_attachments')
                    ->label('')
                    ->boolean(),
                TextColumn::make('subject')
                    ->searchable()
                    ->description(fn ($record) => $record->body_preview)
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
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->slideOver(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
        ];
    }
}
