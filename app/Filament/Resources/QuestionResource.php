<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\GameApp\Question;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationLabel = 'Perguntas';
    protected static ?string $recordTitleAttribute = 'description';

    protected static ?string $navigationGroup = 'Game App';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->label('Descrição'),
                Forms\Components\Select::make('option_id')
                    ->required()
                    ->label('Resposta Correta')
                    ->relationship('correctOption', 'label')
                    ->preload(),
                Forms\Components\Select::make('difficulty')
                    ->required()
                    ->label('Dificuldade')
                    ->options([
                        'easy' => 'Fácil',
                        'medium' => 'Médio',
                        'hard' => 'Difícil',
                    ])
                    ->default('easy'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->label('Descrição')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('correctOption.label')
                    ->label('Resposta Correta')
                    ->sortable(),
                Tables\Columns\TextColumn::make('difficulty')
                    ->label('Dificuldade')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'easy' => 'Fácil',
                        'medium' => 'Médio',
                        'hard' => 'Difícil',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('difficulty')
                    ->options([
                        'easy' => 'Fácil',
                        'medium' => 'Médio',
                        'hard' => 'Difícil',
                    ])
                    ->label('Dificuldade'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
