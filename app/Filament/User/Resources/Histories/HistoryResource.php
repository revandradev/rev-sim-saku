<?php
namespace App\Filament\User\Resources\Histories;

use App\Filament\User\Resources\Histories\Pages\CreateHistory;
use App\Filament\User\Resources\Histories\Pages\EditHistory;
use App\Filament\User\Resources\Histories\Pages\ListHistories;
use App\Filament\User\Resources\Histories\Pages\ViewHistory;
use App\Filament\User\Resources\Histories\Schemas\HistoryForm;
use App\Filament\User\Resources\Histories\Schemas\HistoryInfolist;
use App\Filament\User\Resources\Histories\Tables\HistoriesTable;
use App\Models\History;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'description';
    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['category']);
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['description', 'category.name'];
    }
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            // 'Author'   => $record->user->name,
            'Tanggal'  => $record->date,
            'Kategori' => $record->category->name,
        ];
    }
    protected static ?string $label       = 'Riwayat';
    protected static ?string $pluralLabel = 'Riwayat';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return HistoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HistoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HistoriesTable::configure($table);
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
            'index'  => ListHistories::route('/'),
            'create' => CreateHistory::route('/create'),
            'view'   => ViewHistory::route('/{record}'),
            'edit'   => EditHistory::route('/{record}/edit'),
        ];
    }
}
