<?php

namespace App\Filament\Resources\SocialMediaServiceResource\Pages;

use App\Filament\Resources\SocialMediaServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSocialMediaService extends ViewRecord
{
    protected static string $resource = SocialMediaServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
