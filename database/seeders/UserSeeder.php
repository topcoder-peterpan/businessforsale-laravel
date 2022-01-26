<?php

namespace Database\Seeders;

use App\Models\Customer;
use Carbon\Carbon;
use App\Models\SuperAdmin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::findById(1);
        $user = SuperAdmin::where('email', 'admin@mail.com')->first();
        if (is_null($user)) {
            $user = new SuperAdmin();
            $user->name = "Admin";
            $user->email = "admin@mail.com";
            $user->image = "backend/image/default.png";
            $user->password = bcrypt('password');
            $user->email_verified_at = Carbon::now();
            $user->remember_token = Str::random(10);
            $user->save();
        }
        $user->assignRole($role);
    }
}
