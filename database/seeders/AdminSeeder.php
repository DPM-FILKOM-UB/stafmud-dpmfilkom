<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use App\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsUser::updateOrCreate(
            ['email' => 'masaldoaje@admin.dpm'],
            [
                'nama' => 'Aldo Natanael Sihaloho',
                'password' => 'masaldoaje@1'
            ]
        );

        ModelsUser::updateOrCreate(
            ['email' => 'elbasa@admin.dpm'],
            [
                'nama' => 'El Basa',
                'password' => 'elbasa@1'
            ]
        );
    }
}
