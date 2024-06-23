<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'draft' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'draft'))
                ->badge(Post::query()->where('status', 'draft')->count())
                ->badgeColor('gray'),
            'scheduled' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'scheduled'))
                ->badge(Post::query()->where('status', 'scheduled')->count())
                ->badgeColor('warning'),
            'published' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'published'))
                ->badge(Post::query()->where('status', 'published')->count())
                ->badgeColor('success'),
            'failed' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'failed'))
                ->badge(Post::query()->where('status', 'failed')->count())
                ->badgeColor('danger'),
        ];
    }
}
