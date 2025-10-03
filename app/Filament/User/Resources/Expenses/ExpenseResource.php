<?php
namespace App\Filament\User\Resources\Expenses;

use App\Filament\User\Resources\Expenses\Pages\CreateExpense;
use App\Filament\User\Resources\Expenses\Pages\EditExpense;
use App\Filament\User\Resources\Expenses\Pages\ListExpenses;
use App\Filament\User\Resources\Expenses\Schemas\ExpenseForm;
use App\Filament\User\Resources\Expenses\Tables\ExpensesTable;
use App\Models\Expense;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ExpenseResource extends Resource
{

    protected static ?string $pluralModelLabel = 'Transaksi';
    protected static ?string $model            = Expense::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'description';
    public static function getGloballySearchableAttributes(): array
    {
        return ['description', 'category.name'];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereDate('date', now())->count();
    }

    public static function form(Schema $schema): Schema
    {
        return ExpenseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExpensesTable::configure($table);
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
            'index'  => ListExpenses::route('/'),
            'create' => CreateExpense::route('/create'),
            'edit'   => EditExpense::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id())->whereDate('date', now());
    }
}
