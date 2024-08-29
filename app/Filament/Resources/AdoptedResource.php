<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdoptedResource\Pages;
use App\Filament\Resources\AdoptedResource\RelationManagers;
use App\Models\Adopted;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdoptedResource extends Resource
{
    protected static ?string $model = Adopted::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    public static function getNavigationLabel(): string
    {
        return __('Adopteds');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Adopteds');
    }

    public static function getModelLabel(): string
    {
        return __('Adopted');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Animal Management');
    }

    public static function getNavigationSort(): ?int
    {
        return 3;
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
                    ->relationship('animal', 'name', function (Builder $query, $livewire) {
                        if ($livewire instanceof Pages\CreateAdopted) {
                            return $query->whereDoesntHave('adopted');
                        } elseif ($livewire instanceof Pages\EditAdopted) {
                            return $query->whereDoesntHave('adopted')
                                ->orWhere('id', $livewire->record->animal_id);
                        }
                        return $query;
                    })
                    ->required()
                    ->searchable()
                    ->preload()
                    ->translateLabel(),
                Forms\Components\DatePicker::make('adoption_date')
                    ->required()
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
                Tables\Columns\TextColumn::make('adoption_date')
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
            'index' => Pages\ListAdopteds::route('/'),
            'create' => Pages\CreateAdopted::route('/create'),
            'edit' => Pages\EditAdopted::route('/{record}/edit'),
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
