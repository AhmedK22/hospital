<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Entities\Admin;

class AdminSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

       Admin::create([
            'name' => 'admin',
            'email' =>  'admin@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
    }
}
