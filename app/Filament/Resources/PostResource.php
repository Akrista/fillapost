<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\ServiceAccount;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationLabel = 'Posts';
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('service_account_id')
                    ->label('Service Account')
                    ->options(fn () =>
                    ServiceAccount::all()->mapWithKeys(fn ($serviceAccount) => [
                        $serviceAccount->id => $serviceAccount->name,
                    ])->toArray())
                    ->rules('exists:service_accounts,id')
                    ->autofocus()
                    ->live()
                    ->required(),
                DateTimePicker::make('scheduled_at')
                    ->label('Publish Date')
                    ->minDate(now())
                    ->closeOnDateSelection()
                    ->native(false),
                TextInput::make('title')
                    ->label('Title')
                    ->placeholder('Enter the title of the post')
                    ->rules('string', 'max:255')
                    ->hidden(
                        fn (Get $get) => $get('service_account_id') ? ServiceAccount::find($get('service_account_id'))->socialMediaService()->first()->socialMediaType()->first()->type === 'linkedin' : true
                    )
                    ->required(
                        fn (Get $get) => $get('service_account_id') ? ServiceAccount::find($get('service_account_id'))->socialMediaService()->first()->socialMediaType()->first()->type !== 'linkedin' : false
                    ),
                RichEditor::make('content')
                    ->label('Content')
                    ->placeholder('Enter the content of the post')
                    ->columnSpanFull()
                    ->disableToolbarButtons([])
                    ->rules('string')
                    ->hidden(
                        fn (Get $get) => $get('service_account_id') ? ServiceAccount::find($get('service_account_id'))->socialMediaService()->first()->socialMediaType()->first()->type === 'linkedin' : true
                    )
                    ->required(
                        fn (Get $get) => $get('service_account_id') ? ServiceAccount::find($get('service_account_id'))->socialMediaService()->first()->socialMediaType()->first()->type !== 'linkedin' : false
                    ),
                Textarea::make('content')
                    ->label('Content')
                    ->placeholder('Enter the content of the post')
                    ->columnSpanFull()
                    ->rules('string')
                    ->hidden(
                        fn (Get $get) => $get('service_account_id') ? ServiceAccount::find($get('service_account_id'))->socialMediaService()->first()->socialMediaType()->first()->type !== 'linkedin' : true
                    )
                    ->required(
                        fn (Get $get) => $get('service_account_id') ? ServiceAccount::find($get('service_account_id'))->socialMediaService()->first()->socialMediaType()->first()->type === 'linkedin' : false
                    )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'scheduled' => 'warning',
                        'published' => 'success',
                        'failed' => 'danger',
                    })
                    ->description(fn (Post $record): string => $record->published_at ? date('F j, Y, g:i a', strtotime($record->scheduled_at)) : date('F j, Y, g:i a', strtotime($record->published_at)), position: 'below')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('content')
                    ->label('Content')
                    ->description(fn (Post $record): string => $record->title ? $record->title : '', 'above')
                    ->wrap()
                    ->lineClamp(3)
                    ->searchable()
                    ->sortable(),
                IconColumn::make('serviceAccount.socialMediaService.socialMediaType.type')
                    ->icon(fn (string $state): string => match ($state) {
                        'linkedin' => 'fab-linkedin',
                        'steam' => 'fab-steam',
                        'wakatime' => 'fab-wakatime',
                    })
                    ->label('Service')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter::make('drafts')
                //     ->label('Drafts')
                //     ->query(fn (Builder $query): Builder => $query->where('status', 'draft')),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
