<?php

namespace App\Filament\Resources\SocialMediaServiceResource\Pages;

use App\Filament\Resources\SocialMediaServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSocialMediaService extends EditRecord
{
    protected static string $resource = SocialMediaServiceResource::class;
    protected ?string $heading = 'Edit Service';

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
