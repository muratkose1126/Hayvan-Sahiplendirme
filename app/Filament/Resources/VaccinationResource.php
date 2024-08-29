<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VaccinationResource\Pages;
use App\Filament\Resources\VaccinationResource\RelationManagers;
use App\Models\Vaccination;
use App\Models\Vaccine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;

class VaccinationResource extends Resource
{
    protected static ?string $model = Vaccination::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('Vaccinations');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Vaccinations');
    }

    public static function getModelLabel(): string
    {
        return __('Vaccination');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Animal Management');
    }

    public static function getNavigationSort(): ?int
    {
        return 2;
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
                Forms\Components\Select::make('vaccine_id')
                    ->relationship('vaccine', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->translateLabel()
                    ->live()
                    ->afterStateUpdated(fn (callable $set, callable $get) => self::updateExpirationDate($set, $get)),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->translateLabel()
                    ->live()
                    ->afterStateUpdated(fn (callable $set, callable $get) => self::updateExpirationDate($set, $get)),
                Forms\Components\DatePicker::make('expiration_date')
                    ->readOnly()
                    ->required()
                    ->translateLabel(),
            ]);
    }

    private static function updateExpirationDate(callable $set, callable $get): void
    {
        $vaccineId = $get('vaccine_id');
        $date = $get('date');
        if ($vaccineId && $date) {
            $vaccine = Vaccine::find($vaccineId);
            if ($vaccine) {
                $expirationDate = Carbon::parse($date)->addMonths($vaccine->validity_period);
                $set('expiration_date', $expirationDate->format('Y-m-d'));
            }
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('animal.name')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('vaccine.name')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('date')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVaccinations::route('/'),
            'create' => Pages\CreateVaccination::route('/create'),
            'edit' => Pages\EditVaccination::route('/{record}/edit'),
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
