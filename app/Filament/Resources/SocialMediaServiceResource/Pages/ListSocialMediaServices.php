<?php

namespace App\Filament\Resources\SocialMediaServiceResource\Pages;

use App\Filament\Resources\SocialMediaServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSocialMediaServices extends ListRecords
{
    protected static string $resource = SocialMediaServiceResource::class;
    protected ?string $heading = 'Services';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Register Service'),
        ];
    }
}
