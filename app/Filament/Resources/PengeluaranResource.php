<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengeluaranResource\Pages;
use App\Filament\Resources\PengeluaranResource\RelationManagers;
use App\Models\m_program_pembangunan;
use App\Models\Pengeluaran;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengeluaranResource extends Resource
{
    protected static ?string $model = Pengeluaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Pengeluaran';

    protected static ?string $pluralLabel = 'Pengeluaran';

    protected static ?string $label = 'Pengeluaran';

    protected static ?string $navigationGroup = 'Keuangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tanggal')->label('Tanggal Pembelian')->required()->native(false)->displayFormat('d M Y')->maxDate(now())->prefixIcon('heroicon-o-calendar'),
                Select::make('kategori')->label('Kategori Pengeluaran')->required()
                    ->options([
                        'Material' => 'Pembelian Material',
                        'Upah' => 'Upah Tenaga Kerja',
                        'Sewa' => 'Sewa Peralatan',
                        'Jasa' => 'Jasa Professional / Subkontraktor',
                        'Transportasi' => 'Transportasi & Logistik',
                        'Perizinan' => 'Perizinan & Administrasi',
                        'Operasional' => 'Operasional Lapangan',
                        'Platform' => 'Biaya Platform & Transaksi',
                        'Pemasaran' => 'Pemasaran & Promosi',
                        'Lain - Lain' => 'Lain - Lain / Tak Terduga',
                    ]),
                Select::make('program_id')
                    ->relationship('program', 'nama_pembangunan',fn (Builder $query) => $query->where('status','=', ['pendanaan','berjalan']))
                    ->preload()
                    ->label('Program Pembangunan'),
                TextInput::make('jumlah')->label('Jumlah Pengeluaran')->required()->prefix('Rp.'),
                Textarea::make('deskripsi')->label('Deskripsi Pengeluaran')->required(), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')->date('d m Y')->label('Tanggal Pembelian'),
                TextColumn::make('kategori')->label('Kategori Pengeluaran'),
                TextColumn::make('deskripsi')->label('Deskripsi Pengeluaran'),
                // TextColumn::make('program.nama_program')->label('Program Pembangunan'),
                TextColumn::make('jumlah')->money('IDR')->label('Jumlah Pengeluaran'),
                TextColumn::make('program.nama_pembangunan')->label('Program Pembangunan'),
                SpatieMediaLibraryImageColumn::make('bukti_pembayaran')->label('Bukti Pembayaran')->collection('bukti_pembayaran_pengeluaran'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('bayar')
                    ->label('Bayar Sekarang')
                    ->icon('heroicon-o-arrow-up-on-square')
                    ->color('primary')
                    ->visible(fn ($record): bool => $record->status_pembayaran === "pending" && auth()->user()->hasRole(['Admin','super_admin']) && $record->user_id = auth()->user()->id && $record->sumber_type != null)
                    ->modalHeading('Upload Bukti Pembayaran / Struk Pembelian')
                    ->modalSubmitActionLabel('Upload')
                    ->form([
                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('bukti_pembayaran')
                            ->label('Bukti Pembayaran (JPG/PNG)')
                            ->collection('bukti_pembayaran_pengeluaran')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->conversion('conversion')->maxSize(2048)->helperText('Ukuran maksimum file adalah 2MB.'),
                    ])
                    ->action(function ($record){
                        $record->status_pembayaran = 'sudah';
                        $record->save();
                    }),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListPengeluarans::route('/'),
            'create' => Pages\CreatePengeluaran::route('/create'),
            'edit' => Pages\EditPengeluaran::route('/{record}/edit'),
        ];
    }
}
