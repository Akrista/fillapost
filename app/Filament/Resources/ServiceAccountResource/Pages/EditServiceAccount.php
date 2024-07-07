<?php

namespace App\Filament\Resources\ServiceAccountResource\Pages;

use App\Filament\Resources\ServiceAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceAccount extends EditRecord
{
    protected static string $resource = ServiceAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            // Actions\DeleteAction::make(),
        ];
    }
}
