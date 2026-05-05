<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@simtik.polda.diy'],
            [
                'name' => 'SIMTIK',
                'email' => 'admin@simtik.polda.diy',
                'password' => Hash::make('BIDTIK110'),
            ]
        );
    }
}
