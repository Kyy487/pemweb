<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin E-Rapor',
            'email' => 'admin@erapor.local',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Create Teacher Users
        User::create([
            'name' => 'Guru Matematika',
            'email' => 'guru.matematika@erapor.local',
            'password' => Hash::make('password123'),
            'role' => 'teacher',
        ]);

        User::create([
            'name' => 'Guru Bahasa Indonesia',
            'email' => 'guru.bahasa@erapor.local',
            'password' => Hash::make('password123'),
            'role' => 'teacher',
        ]);

        User::create([
            'name' => 'Guru IPA',
            'email' => 'guru.ipa@erapor.local',
            'password' => Hash::make('password123'),
            'role' => 'teacher',
        ]);

        // Create Student Users
        User::create([
            'name' => 'Siswa Test 1',
            'email' => 'siswa1@erapor.local',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);

        User::create([
            'name' => 'Siswa Test 2',
            'email' => 'siswa2@erapor.local',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);

        User::create([
            'name' => 'Siswa Test 3',
            'email' => 'siswa3@erapor.local',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]);

        $this->command->info('✅ Test users created successfully!');
        $this->command->info('');
        $this->command->info('📝 Login Credentials:');
        $this->command->info('');
        $this->command->info('🔐 Admin:');
        $this->command->info('   Email: admin@erapor.local');
        $this->command->info('   Password: password123');
        $this->command->info('');
        $this->command->info('🧑‍🏫 Guru:');
        $this->command->info('   Email: guru.matematika@erapor.local');
        $this->command->info('   Email: guru.bahasa@erapor.local');
        $this->command->info('   Email: guru.ipa@erapor.local');
        $this->command->info('   Password: password123 (for all)');
        $this->command->info('');
        $this->command->info('👨‍🎓 Siswa:');
        $this->command->info('   Email: siswa1@erapor.local');
        $this->command->info('   Email: siswa2@erapor.local');
        $this->command->info('   Email: siswa3@erapor.local');
        $this->command->info('   Password: password123 (for all)');
        $this->command->info('');
    }
}
