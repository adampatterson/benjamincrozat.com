<?php

namespace App\Filament\Resources\AffiliateResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AffiliateResource;

class ListAffiliates extends ListRecords
{
    protected static string $resource = AffiliateResource::class;

    protected function getHeaderActions() : array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
