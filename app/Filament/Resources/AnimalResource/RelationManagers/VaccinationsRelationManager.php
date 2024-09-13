<?php

namespace App\Filament\Resources\AnimalResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Vaccine;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class VaccinationsRelationManager extends RelationManager
{
    protected static function getRecordLabel(): ?string
    {
        return __("Vaccination");
    }

    public static function getTitle(Model $ownerRecord, string $pageClass) : string
    {
        return __("Vaccinations");
    }

    protected static string $relationship = 'vaccinations';

    public function form(Form $form) : Form
    {
        return $form
            ->schema([
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
    private static function updateExpirationDate(callable $set, callable $get) : void
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
    public function table(Table $table) : Table
    {
        return $table
            ->columns([
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
                    ->translateLabel(),])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
