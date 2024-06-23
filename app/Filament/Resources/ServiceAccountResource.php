<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceAccountResource\Pages;
use App\Filament\Resources\ServiceAccountResource\RelationManagers;
use App\Models\ServiceAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceAccountResource extends Resource
{
    protected static ?string $model = ServiceAccount::class;

    protected static ?string $navigationLabel = 'Accounts';
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Type')
                    ->options([
                        'linkedin' => 'LinkedIn',
                    ])
                    ->required()
                    ->rules('required', 'string'),
                Forms\Components\TextInput::make('token')
                    ->label('Token')
                    ->required()
                    ->rules('required', 'string'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'create' => Pages\CreateServiceAccount::route('/create'),
            'view' => Pages\ViewServiceAccount::route('/{record}'),
            'edit' => Pages\EditServiceAccount::route('/{record}/edit'),
        ];
    }
}
