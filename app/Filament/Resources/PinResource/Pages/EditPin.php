<?php

namespace App\Filament\Resources\PinResource\Pages;

use Filament\Actions;
use App\Filament\Resources\PinResource;
use Filament\Resources\Pages\EditRecord;

class EditPin extends EditRecord
{
    protected static string $resource = PinResource::class;

    protected function getHeaderActions() : array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
