<?php

namespace App\Filament\Resources;

use App\Enums\GenderType;
use App\Filament\Resources\AnimalResource\Pages;
use App\Filament\Resources\AnimalResource\RelationManagers;
use App\Models\Animal;
use App\Enums\AnimalStatus;
use App\Enums\AnimalGender;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnimalResource extends Resource
{
    protected static ?string $model = Animal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel() : string
    {
        return __('Animals');
    }

    public static function getPluralModelLabel() : string
    {
        return __('Animals');
    }

    public static function getModelLabel() : string
    {
        return __('Animal');
    }

    public static function form(Form $form) : Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\Select::make('species_id')
                    ->relationship('species', 'name')
                    ->required()
                    ->translateLabel()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('breed_id', null)),
                Forms\Components\Select::make('breed_id')
                    ->relationship('breed', 'name', fn (Builder $query, callable $get) =>
                        $query->where('species_id', $get('species_id'))
                    )
                    ->required()
                    ->translateLabel()
                    ->searchable()
                    ->preload(),
                Forms\Components\TextInput::make('color')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\TextInput::make('age')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\Select::make('gender')
                    ->options(GenderType::class)
                    ->required()
                    ->translateLabel(),
                Forms\Components\Select::make('status')
                    ->options(AnimalStatus::class)
                    ->required()
                    ->translateLabel(),
                Forms\Components\Toggle::make('desexed')
                    ->inline(false)
                    ->required()
                    ->translateLabel(),
                Forms\Components\TextInput::make('microchip_number')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\TextInput::make('ear_tag_number')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\Textarea::make('description')
                    ->required()
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
                Tables\Columns\TextColumn::make('species.name')
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('breed.name')
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('color')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('age')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\IconColumn::make('desexed')
                    ->boolean()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('microchip_number')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('ear_tag_number')
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
            'index' => Pages\ListAnimals::route('/'),
            'create' => Pages\CreateAnimal::route('/create'),
            'edit' => Pages\EditAnimal::route('/{record}/edit'),
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
