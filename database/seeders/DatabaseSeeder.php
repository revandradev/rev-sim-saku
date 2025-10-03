<?php
namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->createMany([
            [
                'name'     => 'admin User',
                'email'    => 'admin@example.com',
                'password' => bcrypt('password'),
                'role'     => 'admin',
            ],
            [
                'name'     => 'revan',
                'email'    => 'user@example.com',
                'password' => bcrypt('password'),
                'role'     => 'user',
            ],
        ]);
        Category::factory()->createMany(
            [
                [
                    'name' => 'Pemasukan',
                ],
                [
                    'name' => 'Pengeluaran',
                ],
            ]
        );
    }
}
