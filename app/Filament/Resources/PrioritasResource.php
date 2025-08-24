<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrioritasResource\Pages;
use App\Filament\Resources\PrioritasResource\RelationManagers;
use App\Models\Prioritas;
use App\Models\Priority;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class PrioritasResource extends Resource
{
    protected static ?string $model = Priority::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationLabel = 'Prioritas Pembangunan';

    protected static ?string $pluralLabel = 'Pengaturan Prioritas Pembangunan';

    protected static ?string $label = 'Pengaturan Prioritas Pembangunan';

    protected static ?string $navigationGroup = 'Pembangunan';

    protected static ?int $navigationSort = 15;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_priority')
                    ->required()
                    ->label('Nama Variabel Prioritas'),
                TextInput::make('persen_priority')
                    ->required()
                    ->label('Persen')
                    ->suffixIcon('heroicon-o-percent-badge'),
                TextInput::make('deskripsi_priority')
                    ->required()
                    ->label('Deskripsi Prioritas'),
                Radio::make('jenis_kriteria')
                    ->options([
                        'benefit' => 'Keuntungan (Benefit)',
                        'cost' => 'Kerugian (Cost)',
                    ])
                    ->required()
                    ->descriptions([
                       'benefit' => 'Benefit adalah kriteria di mana nilai yang lebih tinggi adalah yang terbaik (misalnya: kualitas, manfaat, laba)',
                       'cost' => 'Cost adalah Kriteria di mana nilai yang lebih rendah adalah yang terbaik (misalnya: biaya, waktu, risiko)'
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        
            ->heading(function (){
                $totalpersentasi = Priority::sum('persen_priority');

                $textColorClass = ($totalpersentasi != 100) ? 'text-danger-500' : 'text-success-500';

                $title = "Jumlah Bobot Prioritas: <span class='{$textColorClass}'>{$totalpersentasi}%</span>";

                return new HtmlString($title);
            })
            ->columns([
                TextColumn::make('nama_priority')
                    ->label('Nama Prioritas')
                    ->icon('heroicon-o-book-open')
                    ->description(fn (Priority $record): string => $record->deskripsi_priority),
                TextColumn::make('persen_priority')
                    ->label('Besar Priority (Dalam Persen (%))')
                    ->icon('heroicon-o-percent-badge'),
                TextColumn::make('jenis_kriteria')
                    ->label('Jenis Kriteria')
                    ->badge()
                    ->color(fn (string $state): string => match ($state){
                        'cost' => 'danger',
                        'benefit' => 'success'
                    })
                    
            ])
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
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePrioritas::route('/'),
        ];
    }
}
