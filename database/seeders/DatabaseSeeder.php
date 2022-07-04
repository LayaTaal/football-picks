<?php

namespace Database\Seeders;

use App\Models\Round;
use App\Models\Season;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'Jason Zinn',
             'email' => 'jay.zinn@gmail.com',
             'password' => bcrypt( 'password' ),
         ]);

         Season::factory()->create();
         Team::factory( 10 )->create();
    }
}
