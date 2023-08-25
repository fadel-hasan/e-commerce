<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Role::create([
            'name' => 'Admin',
        ]);
        Role::create([
            'name' => 'user'
        ]);
        $admin_name = env('Admin_Name');
        $admin_email = env('Admin_Email');
        $admin_password = env('Admin_Password');
        $id = DB::table('roles')->where('name', 'admin')->value('id');
        // $user = User::create([
        //     'name' =>  $admin_name,
        //     'email' => $admin_email,
        //     'password' => Hash::make($admin_password),
        // ]);

        $user = new User();
        $user->name = $admin_name;
        $user->email = $admin_email;
        $user->password = Hash::make($admin_password);
        $user->role_id = $id;
        $user->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
