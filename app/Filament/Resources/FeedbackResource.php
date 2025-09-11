<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Models\m_feedback;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentRatingStar\Columns\Components\RatingStar;
use IbrahimBougaoua\FilamentRatingStar\Forms\Components\RatingStar as ComponentsRatingStar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class FeedbackResource extends Resource
{
    protected static ?string $model = m_feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $label = 'Feedback';

    protected static ?string $navigationLabel = 'Feedback';

    protected static ?string $navigationGroup = 'Feedback';

    protected static ?string $pluralLabel = 'Feedback';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Feedback')
                    ->schema([
                        Hidden::make('user_id')->default(fn () => auth()->id()),
                        TextInput::make('subject_feedback')->label('Subjek Feedback')->required(),
                        TextInput::make('isi_feedback')->label('Isi Subjek')->required(),
                        ComponentsRatingStar::make('rate')->label('Rating'),
                        SpatieMediaLibraryFileUpload::make('Foto feedback')->image()->imageEditor()->multiple()->collection('feedback')->label('Foto Feedback')
                    ])->columns('1')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Feedback')
            ->columns([
                TextColumn::make('user.email')->label("E-Mail")->icon('heroicon-o-user')->searchable(),
                TextColumn::make('subject_feedback')->label('Judul Feedback')->icon('heroicon-o-chat-bubble-left'),
                RatingStar::make('rate')->label('Rating')
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_form')
                            ->label('Dibuat')
                            ->displayFormat('d M Y'),
                        DatePicker::make('created_until')
                            ->label('Sampai')
                            ->displayFormat('d M Y'),
                    ])
                    ->query(function (Builder $query, array $data): Builder{
                        return $query
                            ->when(
                                $data['created_form'], fn (Builder $query, $date): Builder => $query->where('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'], fn (Builder $query, $date): Builder => $query->where('created_at', '>=', $date),
                            );
                    })
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFeedback::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $user = Auth::user();

        if(!$user->hasRole('Admin')){
            $query->where('user_id', $user->id);
        }

        return $query;
    }
}
