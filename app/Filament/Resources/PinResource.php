<?php

namespace App\Filament\Resources;

use App\Models\Pin;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\PinResource\Pages;

class PinResource extends Resource
{
    protected static ?string $model = Pin::class;

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'icon-pin';

    public static function form(Form $form) : Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table) : Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations() : array
    {
        return [
            //
        ];
    }

    public static function getPages() : array
    {
        return [
            'index' => Pages\ListPins::route('/'),
            'create' => Pages\CreatePin::route('/create'),
            'edit' => Pages\EditPin::route('/{record}/edit'),
        ];
    }
}
