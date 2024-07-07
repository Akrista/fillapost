<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialMediaServiceResource\Pages;
use App\Models\SocialMediaService;
use App\Models\SocialMediaType;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Http;

class SocialMediaServiceResource extends Resource
{
    protected static ?string $model = SocialMediaService::class;

    protected static ?string $navigationLabel = 'Services';
    protected static ?string $navigationIcon = 'heroicon-o-server-stack';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('social_media_type_id')
                    ->label('Service')
                    ->options(
                        SocialMediaType::all()->mapWithKeys(fn ($socialMediaType) => [
                            $socialMediaType->id => ucfirst($socialMediaType->type),
                        ])->toArray()
                    )
                    ->required()
                    ->rules('exists:social_media_types,id')
                    ->live(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('token')
                    ->password()
                    ->revealable()
                    ->required(),
                TextInput::make('client_id')
                    ->password()
                    ->revealable()
                    ->hidden(fn (Get $get) => $get('social_media_type_id') !== '1')
                    ->required(fn (Get $get) => $get('social_media_type_id') === '1'),
                TextInput::make('client_secret')
                    ->password()
                    ->revealable()
                    ->hidden(fn (Get $get) => $get('social_media_type_id') !== '1')
                    ->required(fn (Get $get) => $get('social_media_type_id') === '1'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('socialMediaType.type')
                    ->label('Service')
                    ->icon(fn (string $state): string => match ($state) {
                        'linkedin' => 'fab-linkedin',
                        'steam' => 'fab-steam',
                        'wakatime' => 'fab-wakatime',
                    })
                    ->searchable()
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->sortable(),
                TextColumn::make('name')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->searchable()
                    ->sortable(),
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
                Action::make('refresh')->action(
                    fn (SocialMediaService $record) => self::refreshAccounts($record)
                )
                    ->label('Refresh Accounts')
                    ->button()
                    ->icon('heroicon-m-arrow-path'),
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
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
            'index' => Pages\ListSocialMediaServices::route('/'),
            'create' => Pages\CreateSocialMediaService::route('/create'),
            'view' => Pages\ViewSocialMediaService::route('/{record}'),
            'edit' => Pages\EditSocialMediaService::route('/{record}/edit'),
        ];
    }

    public static function refreshAccounts(SocialMediaService $record)
    {
        if ($record->socialMediaType->type === 'linkedin') {
            $response = Http::withToken($record->token)
                ->get('https://api.linkedin.com/v2/userinfo')->json();
            $record->serviceAccount()->updateOrCreate(
                ['internal_id' => $response['sub'],],
                [
                    'name' => $response['name'],
                    'avatar' => $response['picture'],
                ]
            );
        }
    }
}
