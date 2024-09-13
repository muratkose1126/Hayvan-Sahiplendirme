<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdoptionRequestResource\Pages;
use App\Filament\Resources\AdoptionRequestResource\RelationManagers;
use App\Models\AdoptionRequest;
use App\Enums\AdoptionStatus;
use App\Models\Animal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class AdoptionRequestResource extends Resource
{
    protected static ?string $model = AdoptionRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function getNavigationLabel() : string
    {
        return __('AdoptionRequests');
    }

    public static function getPluralModelLabel() : string
    {
        return __('AdoptionRequests');
    }

    public static function getModelLabel() : string
    {
        return __('AdoptionRequest');
    }

    public static function getNavigationGroup() : ?string
    {
        return __('Personal');
    }

    public static function getNavigationSort() : ?int
    {
        return 6;
    }

    public static function form(Form $form) : Form
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
                Forms\Components\Select::make('status')
                    ->options(AdoptionStatus::class)
                    ->required()
                    ->default(AdoptionStatus::New )
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table) : Table
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
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->recordUrl(null);
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
            'index' => Pages\ListAdoptionRequests::route('/'),
            'create' => Pages\CreateAdoptionRequest::route('/create'),
            'edit' => Pages\EditAdoptionRequest::route('/{record}/edit'),
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
