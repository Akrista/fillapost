<?php

namespace App\Filament\Resources\SocialMediaServiceResource\Pages;

use App\Filament\Resources\SocialMediaServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSocialMediaService extends CreateRecord
{
    protected static string $resource = SocialMediaServiceResource::class;
    protected ?string $heading = 'Register Service';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
