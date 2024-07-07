<?php

namespace App\Filament\Resources\ServiceAccountResource\Pages;

use App\Filament\Resources\ServiceAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceAccount extends ViewRecord
{
    protected static string $resource = ServiceAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
