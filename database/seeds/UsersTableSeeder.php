<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('username', 'testy123')
            ->delete();

        User::create([
            'admin' => 1,
            'name' => 'testy mctesterson',
            'email' => 'testy@test.com',
            'biography' => 'a test account',
            'username' => 'testy123',
            'password' => bcrypt('Password1')
        ]);
    }
}
