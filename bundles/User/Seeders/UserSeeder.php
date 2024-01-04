<?php

namespace User\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        for($i =0; $i<= 1000; $i++) {
             User::factory(1)->create([
                 'is_admin' => rand(0,1),
                 'is_verified' => rand(0,1)
             ]);
        }
    }
}
