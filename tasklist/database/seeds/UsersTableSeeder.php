<?php

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
        factory(User::class)->create([
            'name' => 'noguchi-ryota',
            'email' => 'very.kamonohashi@gmail.com'
        ]);
    }
}
