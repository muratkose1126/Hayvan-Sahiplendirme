<?php

namespace App\Filament\Resources;

use App\Enums\AnimalAgeType;
use Filament\Forms;
use Filament\Tables;
use App\Models\Animal;
use Filament\Forms\Form;
use App\Enums\GenderType;
use Filament\Tables\Table;
use App\Enums\AnimalGender;
use App\Enums\AnimalStatus;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AnimalResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AnimalResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

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

    public static function getNavigationGroup() : ?string
    {
        return __('Personal');
    }

    public static function getNavigationSort() : ?int
    {
        return 1;
    }

    public static function form(Form $form) : Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make()
                    ->schema([

                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->translateLabel(),
                        Forms\Components\TextInput::make('microchip_number')
                            ->required()
                            ->maxLength(255)
                            ->translateLabel(),
                        Forms\Components\TextInput::make('ear_tag_number')
                            ->required()
                            ->maxLength(255)
                            ->translateLabel(),
                    ])
                    ->columns(3)
                    ->columnSpan(1),
                    Forms\Components\Fieldset::make()
                    ->translateLabel()
                    ->schema([
                        Forms\Components\TextInput::make('age.min')
                            ->required()
                            ->numeric()
                            ->label(__('Age min')),
                        Forms\Components\TextInput::make('age.max')
                            ->numeric()
                            ->label(__('Age max')),
                        Forms\Components\Select::make('age.unit')
                            ->options(AnimalAgeType::class)
                            ->required()
                            ->native(false)
                            ->label(__('Age unit')),
                    ])
                    ->columns(3)
                    ->columnSpan(1),
                Forms\Components\Fieldset::make()
                    ->schema([

                        Forms\Components\Select::make('species_id')
                            ->relationship('species', 'name')
                            ->required()
                            ->translateLabel()
                            ->reactive()
                            ->native(false)
                            ->afterStateUpdated(fn (callable $set) => $set('breed_id', null)),
                        Forms\Components\Select::make('breed_id')
                            ->relationship('breed', 'name', fn (Builder $query, callable $get) =>
                                $query->where('species_id', $get('species_id'))
                            )
                            ->required()
                            ->translateLabel()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('gender')
                            ->options(GenderType::class)
                            ->required()
                            ->translateLabel(),
                        Forms\Components\TextInput::make('color')
                            ->required()
                            ->maxLength(255)
                            ->translateLabel(),
                        Forms\Components\Radio::make('desexed')
                            ->options([
                                1 => __('Yes'),
                                0 => __('No'),
                            ])
                            ->required()
                            ->inline()
                            ->inlineLabel(false)
                            ->translateLabel(),
                    ])->columns(5),


                Forms\Components\Fieldset::make()
                    ->schema([

                        Forms\Components\Select::make('location_id')
                            ->relationship('location', 'name')
                            ->translateLabel(),

                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->disableToolbarButtons(["attachFiles"])
                            ->columnSpanFull()
                            ->translateLabel(),
                        SpatieMediaLibraryFileUpload::make('images')
                            ->collection('animal_image')
                            ->translateLabel()
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/heic'])
                            ->columnSpan(2)
                            ->panelLayout('grid'),

                        SpatieMediaLibraryFileUpload::make('videos')
                            ->collection('animal_video')
                            ->translateLabel()
                            ->multiple()
                            ->acceptedFileTypes(['video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/mpeg'])
                            ->columnSpan(2)
                            ->panelLayout('grid')
                    ])
                    ->columns(4)
                    ->columnSpanFull()
            ])
        ;
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
                Tables\Columns\TextColumn::make('gender')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('age')
                    ->formatStateUsing(function ($record) {
                        $min = $record->age['min'];
                        $max = $record->age['max'] ?? $min;
                        $unit = __(ucfirst($record->age['unit']));
                        return $min === $max ? "{$min} {$unit}" : "{$min}-{$max} {$unit}";
                    })
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('color')
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
                Tables\Columns\TextColumn::make('location.name')
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
            RelationManagers\VaccinationsRelationManager::class,
            RelationManagers\AdoptedRelationManager::class,
            RelationManagers\AdoptableRelationManager::class,
            RelationManagers\AdoptionRequestsRelationManager::class,
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
