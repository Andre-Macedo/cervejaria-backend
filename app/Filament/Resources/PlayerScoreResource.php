<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlayerScoreResource\Pages;
use App\Filament\Resources\PlayerScoreResource\RelationManagers;
use App\Models\GameApp\PlayerScore;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class PlayerScoreResource extends Resource
{
    protected static ?string $model = PlayerScore::class;
    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    protected static ?string $navigationLabel = 'Ranking';
    protected static ?string $recordTitleAttribute = 'player_name';
    protected static ?string $navigationGroup = 'Game App';

    public static function getEloquentQuery(): Builder
    {
        return PlayerScore::query()
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('player_scores')
                    ->groupBy('player_id')
                    ->whereIn('score', function ($subQuery) {
                        $subQuery->select(DB::raw('MAX(score)'))
                            ->from('player_scores')
                            ->groupBy('player_id');
                    });
            })
            ->with('player') // Ensure the relationship loads
            ->orderByDesc('score')
            ->orderBy('created_at');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('player_id')
                    ->label('Jogador')
                    ->relationship('player', 'name')
                    ->required(),
                Forms\Components\TextInput::make('score')
                    ->required()
                    ->numeric()
                    ->label('Pontuação'),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('player.name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('score')
                    ->label('Pontuação')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime()
                    ->sortable(),
                ])
            ->defaultSort('score', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make()
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
            'index' => Pages\ListPlayerScores::route('/'),
            'create' => Pages\CreatePlayerScore::route('/create'),
            'edit' => Pages\EditPlayerScore::route('/{record}/edit'),
        ];
    }
}
