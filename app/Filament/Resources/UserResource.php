<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form) : Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->collapsible()
                    ->heading('Credentials')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->email()
                            ->unique(User::class, 'email', ignoreRecord: true),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->visibleOn('create'),
                    ]),

                Forms\Components\Section::make()
                    ->collapsible()
                    ->heading('Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),

                        Forms\Components\MarkdownEditor::make('description')
                            ->nullable(),

                        Forms\Components\TextInput::make('github_handle')
                            ->nullable()
                            ->label('GitHub'),

                        Forms\Components\TextInput::make('twitter_handle')
                            ->nullable()
                            ->label('Twitter'),
                    ]),
            ])
            ->columns(1);
    }

    public static function table(Table $table) : Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('name')
                            ->searchable()
                            ->sortable()
                            ->weight('medium'),

                        Tables\Columns\TextColumn::make('email')
                            ->searchable()
                            ->sortable()
                            ->color('gray'),
                    ])->space(),

                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('twitter_handle')
                            ->searchable()
                            ->sortable()
                            ->icon('icon-twitter')
                            ->label('Twitter'),

                        Tables\Columns\TextColumn::make('github_handle')
                            ->searchable()
                            ->sortable()
                            ->icon('icon-github')
                            ->label('GitHub'),
                    ])->space(),
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages() : array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
        ];
    }
}
