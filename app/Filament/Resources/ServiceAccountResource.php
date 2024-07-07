<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceAccountResource\Pages;
use App\Models\ServiceAccount;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceAccountResource extends Resource
{
    protected static ?string $model = ServiceAccount::class;

    protected static ?string $navigationLabel = 'Accounts';
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('internal_id')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('avatar'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('socialMediaService.socialMediaType.type')
                    ->label('Service Type')
                    ->icon(fn (string $state): string => match ($state) {
                        'linkedin' => 'fab-linkedin',
                        'steam' => 'fab-steam',
                        'wakatime' => 'fab-wakatime',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('socialMediaService.name')
                    ->label('Service Name')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('avatar')
                    ->circular(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceAccounts::route('/'),
            // 'create' => Pages\CreateServiceAccount::route('/create'),
            'view' => Pages\ViewServiceAccount::route('/{record}'),
            'edit' => Pages\EditServiceAccount::route('/{record}/edit'),
        ];
    }
}
