<?php
namespace App\Filament\User\Resources\Expenses\Schemas;

use App\Models\Category;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Pengeluaran/Pemasukan')
                    ->description('Isi detail pengeluaran atau pemasukan Anda di sini.')
                // ->columns(2)
                // ->columns(12)
                    ->columnSpanFull()
                    ->schema([
                        Select::make('category_id')
                            ->label('Kategori')
                            ->options(
                                Category::pluck('name', 'id')
                                    ->map(fn($name) => ucwords($name))
                                    ->toArray()
                            )
                            ->searchable()
                            ->required(),

                        TextInput::make('amount')
                            ->label('Jumlah')
                            ->prefix('Rp')
                            ->mask(RawJs::make('$money($input,\',\')'))
                            ->stripCharacters('.')
                            ->numeric()
                            ->required()
                            ->validationMessages([
                                'required' => ':attribute tidak boleh kosong',
                            ]),

                        DatePicker::make('date')
                            ->label('Tanggal')
                            ->required()->default(now()),

                        Textarea::make('description')
                            ->rules(['required', 'min:3'])
                            ->label('Deskripsi')
                            ->autosize()
                            ->minLength(3)
                            ->dehydrateStateUsing(fn($state) => ucfirst($state))
                            ->validationMessages([
                                'required'   => ':attribute tidak boleh kosong',
                                'min_length' => ':attribute minimal 3 karakter',
                            ])
                        ,
                    ]),

            ]);
    }
}
