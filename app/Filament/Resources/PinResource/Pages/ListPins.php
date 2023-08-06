<?php

namespace App\Filament\Resources\PinResource\Pages;

use Filament\Actions;
use App\Filament\Resources\PinResource;
use Filament\Resources\Pages\ListRecords;

class ListPins extends ListRecords
{
    protected static string $resource = PinResource::class;

    protected function getHeaderActions() : array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
