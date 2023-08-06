<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\PostResource\Pages;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form) : Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->collapsible()
                    ->heading('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\MarkdownEditor::make('introduction')
                            ->nullable()
                            ->columnSpanFull(),

                        Forms\Components\MarkdownEditor::make('content')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\MarkdownEditor::make('conclusion')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make()
                    ->collapsible()
                    ->heading('Other')
                    ->schema([
                        Forms\Components\TextInput::make('image')
                            ->nullable()
                            ->url()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(Post::class, 'slug', ignoreRecord: true)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->nullable()
                            ->columnSpanFull(),

                        Forms\Components\MarkdownEditor::make('teaser')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table) : Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->size(48)
                    ->square(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->searchable()
                    ->label('Author'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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

    public static function getPages() : array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
