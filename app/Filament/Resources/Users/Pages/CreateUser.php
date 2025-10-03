<?php
namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return 'Tambah Pengguna';
    }

    protected function getFormActions(): array
    {
        $actions = parent::getFormActions();

        foreach ($actions as $action) {
            if (method_exists($action, 'getName')) {
                if ($action->getName() === 'create') {
                    $action->label('Simpan Pengguna');
                }
                if ($action->getName() === 'cancel') {
                    $action->label('Batal');
                }
                if ($action->getName() === 'createAnother') {
                    $action->label('Simpan & Tambah Lagi');
                }
            }
        }

        return $actions;
    }
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
