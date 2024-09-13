<?php

namespace App\Filament\Resources\AnimalResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AdoptableRelationManager extends RelationManager
{
    protected static function getRecordLabel() : ?string
    {
        return __("Publish");
    }

    public static function getTitle(Model $ownerRecord, string $pageClass) : string
    {
        return __("Publish");
    }
    protected static string $relationship = 'adoptable';

    public function form(Form $form) : Form
    {
        return $form
            ->schema([
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

    public function table(Table $table) : Table
    {
        return $table
            ->columns([
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
                    ->translateLabel(),])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
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
            ->emptyStateActions(
                [
                    Tables\Actions\CreateAction::make(),
                ]
            );
    }
}
