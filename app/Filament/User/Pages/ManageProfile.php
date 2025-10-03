<?php
namespace App\Filament\User\Pages;

use App\Models\UserProfile;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Size;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class ManageProfile extends Page
{
    protected string $view                    = 'filament.user.pages.manage-profile';
    protected static ?string $navigationLabel = 'Data Diri';
    protected static ?string $model           = UserProfile::class;
    protected static ?string $title           = 'Pengaturan data diri';

    protected static string|UnitEnum|null $navigationGroup  = 'Pengaturan';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    public ?array $data = [];
    public function getBreadcrumbs(): array
    {
        return [
            route('filament.user.pages.dashboard')      => 'Dashboard',
            route('filament.user.pages.manage-profile') => 'Data Diri',
        ];
    }
    public function mount(): void
    {
        $this->form->fill($this->getRecord()?->attributesToArray());

    }
    public function getRecord(): ?UserProfile
    {

        return UserProfile::query()
            ->where('user_id', Auth::user()->id)
            ->first();
    }
    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([
                Section::make('Data Diri')
                    ->description('Mohon lengkapi data diri Anda dengan benar.')
                    ->schema([
                        TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(6), // setengah dari 12 kolom

                        DatePicker::make('birth_date')
                            ->label('Tanggal Lahir')
                            ->native(false)
                            ->maxDate(now())
                            ->columnSpan(6), // setengah dari 12 kolom

                        Radio::make('gender')
                            ->label('Jenis Kelamin')
                            ->options([
                                'male'   => 'Laki-laki',
                                'female' => 'Perempuan',
                            ])
                            ->inline()
                            ->columnSpan(6),

                        TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->maxLength(15)
                            ->required()
                            ->columnSpan(6),
                        Textarea::make('address')
                            ->label('Alamat')
                            ->rows(3)
                            ->autosize()
                            ->required()
                            ->columnSpan(6), // alamat full width
                        FileUpload::make('profile_photo')
                            ->label('Foto Profil')
                            ->image()
                            ->directory('profile-photos')
                            ->maxSize(2048)
                            ->disk('public')
                            ->visibility('public')
                            ->avatar()
                            ->columnSpan(6),
                    ])->columns(12),

            ])
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make([
                        Action::make('save')
                            ->label('Simpan')
                            ->submit('save')
                            ->size(Size::Large)
                            ->keyBindings(['mod+s']),
                    ]),
                ]),
        ])
            ->record($this->getRecord())
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $record = $this->getRecord();

        if (! $record) {
            $record          = new UserProfile();
            $record->user_id = Auth::id();
        }

        $record->fill($data);
        $record->save();

        if ($record->wasRecentlyCreated) {
            $this->form->record($record)->saveRelationships();
        }

        Notification::make()
            ->success()
            ->title('Profil berhasil disimpan')
            ->send();
    }

}
