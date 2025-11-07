<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeriodeResource\Pages;
use App\Filament\Resources\PeriodeResource\RelationManagers;
use App\Models\m_periode;
use App\Models\Periode;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeriodeResource extends Resource
{
    protected static ?string $model = m_periode::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'Periode';

    protected static ?string $navigationGroup = 'Pembangunan';

    protected static ?string $pluralLabel = 'Periode';

    protected static ?string $label = 'Periode'; 

    protected static ?int $navigationSort = 12;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_periode')
                    ->label('Nama Periode')
                    ->placeholder('2025/2026')
                    ->required()
                    ->prefixIcon('heroicon-o-clock')
                    ->extraAttributes(['data-cy' => 'nama-periode']),
                DatePicker::make('tahun_mulai')
                    ->label('Tahun Mulai')
                    ->required()
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->prefixIcon('heroicon-o-calendar')
                    ->extraAttributes(['data-cy' => 'tahun-mulai']),
                DatePicker::make('tahun_selesai')
                    ->required()
                    ->label('Tahun Selesai')
                    ->displayFormat('d M Y')
                    ->native(false)
                    ->prefixIcon('heroicon-o-calendar')
                    ->extraAttributes(['data-cy' => 'tahun-selesai']),
                Hidden::make('status')
                    ->default('nonaktif')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_periode')
                    ->label('Nama Periode'),
                TextColumn::make('tahun_mulai')
                    ->label('Tahun Mulai')
                    ->date('d M Y'),
                TextColumn::make('tahun_selesai')
                    ->label('Tahun Selesai')
                    ->date('d M Y'),
                SelectColumn::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Non - Aktif',
                        'selesai' => 'Selesai',
                    ])
                    ->label('Status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->extraAttributes(['data-cy' => 'edit-periode']),
                Tables\Actions\DeleteAction::make()->extraAttributes(['data-cy' => 'delete-periode']),
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
            'index' => Pages\ManagePeriodes::route('/'),
        ];
    }
}
