<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VaccineResource\Pages;
use App\Filament\Resources\VaccineResource\RelationManagers;
use App\Models\Vaccine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VaccineResource extends Resource
{
    protected static ?string $model = Vaccine::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel() : string
    {
        return __('Vaccines');
    }

    public static function getPluralModelLabel() : string
    {
        return __('Vaccines');
    }

    public static function getModelLabel() : string
    {
        return __('Vaccine');
    }
    public static function getNavigationGroup() : ?string
    {
        return __('Definitions');
    }

    public static function getNavigationSort() : ?int
    {
        return 8;
    }

    public static function form(Form $form) : Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\TextInput::make('validity_period')
                    ->required()
                    ->numeric()
                    ->placeholder(__('Month'))
                    ->translateLabel(),
                Forms\Components\Textarea::make('description')
                    ->maxLength(1000)
                    ->columnSpanFull()
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table) : Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('validity_period')
                    ->numeric()
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
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
                Tables\Columns\TextColumn::make('deleted_at')
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

    public static function getRelations() : array
    {
        return [
            //
        ];
    }

    public static function getPages() : array
    {
        return [
            'index' => Pages\ListVaccines::route('/'),
            'create' => Pages\CreateVaccine::route('/create'),
            'edit' => Pages\EditVaccine::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery() : Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
