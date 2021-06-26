<?php

use Illuminate\Database\Seeder;
use App\Role;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        	'name' => 'Admin',
        	'slug' => Str::slug('Admin'),
        ]);

        Role::create([
        	'name' => 'Author',
        	'slug' => Str::slug('Author'),
        ]);
    }
}
