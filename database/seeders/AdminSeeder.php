<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'josecortesdev';
        $admin->email = 'josecortesdev@gmail.com';
        $admin->email_verified_at = now();
        $admin->password = env('ADMIN_PASSWORD', null);
        $admin->role = 1;
        $admin->remember_token = Str::random(10);

        $admin->save();
    }
}
