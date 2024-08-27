<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdoptionRequestResource\Pages;
use App\Filament\Resources\AdoptionRequestResource\RelationManagers;
use App\Models\AdoptionRequest;
use App\Enums\AdoptionStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdoptionRequestResource extends Resource
{
    protected static ?string $model = AdoptionRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function getNavigationLabel(): string
    {
        return __('AdoptionRequests');
    }

    public static function getPluralModelLabel(): string
    {
        return __('AdoptionRequests');
    }

    public static function getModelLabel(): string
    {
        return __('AdoptionRequest');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('adopter_id')
                    ->relationship('adopter', 'fullname')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->translateLabel(),
                Forms\Components\Select::make('animal_id')
                    ->relationship('animal', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->translateLabel(),
                Forms\Components\Select::make('status')
                    ->options(AdoptionStatus::class)
                    ->required()
                    ->default(AdoptionStatus::New)
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('adopter.fullname')
                    ->searchable()
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('animal.name')
                    ->searchable()
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\SelectColumn::make('status')
                    ->options(AdoptionStatus::class)
                    ->searchable()
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAdoptionRequests::route('/'),
            'create' => Pages\CreateAdoptionRequest::route('/create'),
            'edit' => Pages\EditAdoptionRequest::route('/{record}/edit'),
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
