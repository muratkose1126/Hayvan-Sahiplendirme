<?php

namespace App\Filament\Resources;

use App\Enums\SexType;
use App\Filament\Resources\AdopterResource\Pages;
use App\Filament\Resources\AdopterResource\RelationManagers;
use App\Models\Adopter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdopterResource extends Resource
{
    protected static ?string $model = Adopter::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationLabel(): string
    {
        return __('Adopters');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Adopters');
    }

    public static function getModelLabel(): string
    {
        return __('Adopter');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Adopter Management');
    }

    public static function getNavigationSort(): ?int
    {
        return 5;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('identity_number')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\DatePicker::make('birth_date')
                    ->required()
                    ->translateLabel(),
                Forms\Components\TextInput::make('fullname')
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\Select::make('sex')
                    ->required()
                    ->options(SexType::class)
                    ->translateLabel(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255)
                    ->translateLabel(),
                Forms\Components\Textarea::make('address')
                    ->required()
                    ->maxLength(1000)
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('identity_number')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date()
                    ->sortable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('fullname')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('sex')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('address')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdopters::route('/'),
            'create' => Pages\CreateAdopter::route('/create'),
            'edit' => Pages\EditAdopter::route('/{record}/edit'),
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
