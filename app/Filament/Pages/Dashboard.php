<?php

namespace App\Filament\Pages;

use App\Livewire\StatsOverview;
use Filament\Pages\Dashboard as PagesDashboard;

class Dashboard extends PagesDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?int $navigationSort = 2;

    // use HasFiltersForm;

    // public function filtersForm(Form $form): Form
    // {
    //     return $form->schema([
    //         TextInput::make('search')
    //             ->placeholder('Search...')
    //             ->label('Search'),
    //     ]);
    // }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}
