<?php
namespace App\Filament\User\Resources\Expenses\Pages;

use App\Filament\User\Resources\Expenses\ExpenseResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateExpense extends CreateRecord
{
    protected static string $resource       = ExpenseResource::class;
    protected static bool $canCreateAnother = false;
    protected static ?string $title         = 'Tambah Transaksi';

    protected function getSubmitButtonLabel(): string
    {
        return 'Simpan';
    }

    protected function getCancelButtonLabel(): string
    {
        return 'Batal';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
