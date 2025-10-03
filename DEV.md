# Dokumentasi Custom Kode Laravel Filament Boilerplate

## 1. Struktur Resource & Schema
- **Resource** (UserResource) mengatur konfigurasi utama, label, dan routing halaman CRUD.
- **Schema** (UserForm) digunakan untuk form tambah & edit user, otomatis menyesuaikan context (add/edit).

## 2. Form Password Optional Saat Edit
- Field password hanya required saat tambah user:
  ```php
  TextInput::make('password')
      ->password()
      ->label('Password')
      ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
      ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
      ->dehydrated(fn ($state) => filled($state)),
  ```
- Saat edit, password boleh kosong dan tidak akan diubah jika tidak diisi.

## 3. Kustomisasi Label & Aksi
- Label tombol dan judul halaman bisa diubah dengan override method di page (CreateUser, EditUser, ListUsers).
- Contoh mengganti label tombol simpan, batal, dan simpan & tambah lagi:
  ```php
  protected function getFormActions(): array
  {
      $actions = parent::getFormActions();
      foreach ($actions as $action) {
          if (method_exists($action, 'getName')) {
              if ($action->getName() === 'create') $action->label('Simpan Pengguna');
              if ($action->getName() === 'cancel') $action->label('Batal');
              if ($action->getName() === 'createAnother') $action->label('Simpan & Tambah Lagi');
              if ($action->getName() === 'save') $action->label('Simpan Perubahan');
              if ($action->getName() === 'saveAnother') $action->label('Simpan & Edit Lagi');
          }
      }
      return $actions;
  }
  ```

## 4. Bulk Action & Modal
- Untuk mengubah label bulk action (hapus massal), edit di schema table:
  ```php
  use Filament\Tables\Actions\BulkActionGroup;
  use Filament\Tables\Actions\DeleteBulkAction;

  ->bulkActions([
      BulkActionGroup::make([
          DeleteBulkAction::make()
              ->label('Hapus Terpilih')
              ->modalHeading('Konfirmasi Hapus Pengguna Terpilih')
              ->modalDescription('Apakah Anda yakin ingin menghapus pengguna-pengguna yang dipilih? Tindakan ini tidak dapat dibatalkan.'),
      ]),
  ])
  ```

## 5. Redirect Setelah Edit
- Setelah edit user, otomatis redirect ke halaman list user:
  ```php
  public function getRedirectUrl(): string
  {
      return $this->getResource()::getUrl('index');
  }
  ```

## 6. Breadcrumb & Judul
- Breadcrumb dan judul halaman bisa diubah dengan override method `getBreadcrumb()` dan `getTitle()` di masing-masing page.

---

**Catatan:**  
Selalu cek apakah menggunakan custom schema/table, karena pengaturan di page bisa diabaikan jika sudah diatur di schema.
