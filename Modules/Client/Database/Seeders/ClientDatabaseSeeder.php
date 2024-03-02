<?php

namespace Modules\Client\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Client\Entities\Model as Client;

class ClientDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        $client = Client::create([
            'country_id' => 2,
            'name' => 'abdo',
            'email' => 'abdo@gmail.com',
            'phone' => '1551831192',
            'password' => Hash::make('1551831192'),
        ]);
    }
}
