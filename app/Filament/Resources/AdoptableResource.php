<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdoptableResource\Pages;
use App\Filament\Resources\AdoptableResource\RelationManagers;
use App\Models\Adoptable;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdoptableResource extends Resource
{
    protected static ?string $model = Adoptable::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    public static function getNavigationLabel(): string
    {
        return __('Adoptables');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Adoptables');
    }

    public static function getModelLabel(): string
    {
        return __('Adoptable');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Animal Management');
    }

    public static function getNavigationSort(): ?int
    {
        return 4;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('animal_id')
                    ->relationship('animal', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->translateLabel(),
                Forms\Components\Toggle::make('is_published')
                    ->inline(false)
                    ->required()
                    ->translateLabel(),
                Forms\Components\DatePicker::make('publish_date')
                    ->required()
                    ->translateLabel(),
                Forms\Components\DatePicker::make('expiration_date')
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('animal.name')
                    ->searchable()
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('publish_date')
                    ->date()
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('expiration_date')
                    ->date()
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->translateLabel(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdoptables::route('/'),
            'create' => Pages\CreateAdoptable::route('/create'),
            'edit' => Pages\EditAdoptable::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
