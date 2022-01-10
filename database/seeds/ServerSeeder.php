<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('servers')->insert([
                'name'    => Str::random(10),
                'owner' => Str::random(10),
                'status' => 'online',
                'ip' => 'localhost',
                'port' => '00000',
                'version'            => '1.7.2',
                'maxPlayers'    => '4',
                'difficulty'        => 'normal',
                'nether'    => 'true',
                'hardcore'    => 'true',
                'pvp'    => 'true',
                'premium'    => 'true',
                'autokick'  => '5',
            ]);
    }
}
