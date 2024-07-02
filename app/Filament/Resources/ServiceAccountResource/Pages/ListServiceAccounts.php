<?php

namespace App\Filament\Resources\ServiceAccountResource\Pages;

use App\Filament\Resources\ServiceAccountResource;
use Filament\Resources\Pages\ListRecords;

class ListServiceAccounts extends ListRecords
{
    protected static string $resource = ServiceAccountResource::class;
    protected ?string $heading = 'Accounts';

    protected function getHeaderActions(): array
    {
        return [];
    }
}
