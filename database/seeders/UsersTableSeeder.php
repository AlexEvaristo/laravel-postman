<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Paulo Alex',
            'email' => 'paulo.alex.evaristo@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
