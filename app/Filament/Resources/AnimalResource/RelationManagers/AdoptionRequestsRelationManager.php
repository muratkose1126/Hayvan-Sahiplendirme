<?php

namespace App\Filament\Resources\AnimalResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\AdoptionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AdoptionRequestsRelationManager extends RelationManager
{
    protected static function getRecordLabel() : ?string
    {
        return __("AdoptionRequests");
    }

    public static function getTitle(Model $ownerRecord, string $pageClass) : string
    {
        return __("AdoptionRequests");
    }

    protected static string $relationship = 'adoptionRequests';

    public function form(Form $form) : Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table) : Table
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
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->translateLabel(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn (Model $record) => $record->status == AdoptionStatus::New ),
                Tables\Actions\Action::make('işlemeAl')
                    ->visible(fn (Model $record) => $record->status == AdoptionStatus::New )
                    ->action(function (Model $record) {
                        $record->status = AdoptionStatus::Pending;
                        $record->save();
                    })
                    ->icon('heroicon-o-document-text'),
                Tables\Actions\Action::make('onayla')
                    ->visible(fn (Model $record) => $record->status == AdoptionStatus::Pending)
                    ->action(function (Model $record) {
                        $record->status = AdoptionStatus::Complete;
                        $record->save();
                    })
                    ->icon('heroicon-o-check'),
                Tables\Actions\Action::make('reddet')
                    ->visible(fn (Model $record) => $record->status == AdoptionStatus::Pending)
                    ->action(function (Model $record) {
                        $record->status = AdoptionStatus::Reject;
                        $record->save();
                    })
                    ->icon('heroicon-o-x-mark'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
