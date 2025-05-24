<?php

namespace App\Filament\Resources\PlayerScoreResource\Pages;

use App\Filament\Resources\PlayerScoreResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlayerScores extends ListRecords
{
    protected static string $resource = PlayerScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
