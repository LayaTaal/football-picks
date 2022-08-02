<?php

namespace Database\Seeders;

use App\Models\Round;
use App\Models\Season;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
    const teams = [
        'Arizona Cardinals',
        'Atlanta Falcons',
        'Baltimore Ravens',
        'Buffalo Bills',
        'Carolina Panthers',
        'Chicago Bears',
        'Cincinnati Bengals',
        'Cleveland Browns',
        'Dallas Cowboys',
        'Denver Broncos',
        'Detroit Lions',
        'Green Bay Packers',
        'Houston Texans',
        'Indianapolis Colts',
        'Jacksonville Jaguars',
        'Kansas City Chiefs',
        'Las Vegas Raiders',
        'Los Angeles Chargers',
        'Los Angeles Rams',
        'Miami Dolphins',
        'Minnesota Vikings',
        'New England Patriots',
        'New Orleans Saints',
        'New York Giants',
        'New York Jets',
        'Philadelphia Eagles',
        'Pittsburgh Steelers',
        'San Francisco 49ers',
        'Seattle Seahawks',
        'Tampa Bay Buccaneers',
        'Tennessee Titans',
        'Washington Commanders',
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        User::factory()->create( [
            'name'     => 'Jason Zinn',
            'email'    => 'jay.zinn@gmail.com',
            'password' => bcrypt( 'password' ),
        ] );

        User::factory()->create( [
            'name'     => 'John Doe',
            'email'    => 'john@doe.com',
            'password' => bcrypt( 'password' ),
        ] );

        Season::factory()->create(
            [ 'title' => '2022' ],
        );

        $this->generate_teams();
    }

    public function generate_teams() {
        foreach ( self::teams as $team ) {
            Team::factory()->create( [
                'name' => $team,
                'slug' => Str::slug( $team ),
            ] );
        }
    }
}
