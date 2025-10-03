<?php
namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->label('Hapus Pengguna')
                ->modalHeading('Konfirmasi Hapus Pengguna')
                ->modalDescription('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.'),
        ];
    }

    protected function getFormActions(): array
    {
        $actions = parent::getFormActions();

        foreach ($actions as $action) {
            if (method_exists($action, 'getName')) {
                if ($action->getName() === 'save') {
                    $action->label('Simpan Perubahan');
                }
                if ($action->getName() === 'cancel') {
                    $action->label('Batal');
                }
                if ($action->getName() === 'saveAnother') {
                    $action->label('Simpan & Edit Lagi');
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
