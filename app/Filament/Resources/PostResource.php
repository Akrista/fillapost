<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use App\Models\ServiceAccount;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationLabel = 'Posts';
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('serviceAccount.name')
                    ->label('Service Account')
                    ->options(fn () => ServiceAccount::all()->pluck('type', 'name')->toArray())
                    ->required()
                    ->rules('required', 'exists:service_accounts,name'),
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->placeholder('Enter the title of the post')
                    ->rules('string', 'max:255'),
                Textarea::make('content')
                    ->label('Content')
                    ->required()
                    ->placeholder('Enter the content of the post')
                    ->rules('required', 'string', 'max:3000'),
                DatePicker::make('scheduled_at')
                    ->label('Published At')
                    ->required()
                    ->rules('date'),
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
                    ->description(fn (Post $record): string => $record->title ? $record->title : null, 'above')
                    ->wrap()
                    ->lineClamp(3)
                    ->searchable()
                    ->sortable(),
                IconColumn::make('serviceAccount.type')
                    ->icon(fn (string $state): string => match ($state) {
                        'linkedin' => 'fab-linkedin'
                    })
                    ->label('Account')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
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
