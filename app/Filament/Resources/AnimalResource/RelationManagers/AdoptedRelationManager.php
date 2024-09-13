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

class AdoptedRelationManager extends RelationManager
{
    protected static function getRecordLabel(): ?string
    {
        return __("Adopter");
    }

    public static function getTitle(Model $ownerRecord, string $pageClass) : string
    {
        return __("Adopter");
    }

    protected static string $relationship = 'adopted';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('adopter_id')
                    ->relationship('adopter', 'fullname')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->translateLabel()
                    ->columnSpanFull()
                    ->live(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('adopter.fullname')->label(__('Fullname')),
                Tables\Columns\TextColumn::make('adopter.email')->label(__('Email')),
                Tables\Columns\TextColumn::make('adopter.phone')->label(__('Phone')),
                Tables\Columns\TextColumn::make('adopter.address')->label(__('Address')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
