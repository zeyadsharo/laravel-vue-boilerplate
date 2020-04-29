<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      
        // foreach ($permission as $value) {
       
        //  DB::table('permissions')->insert([
        //  'name' => $value,
        //  'guard_name'=>'web',
        //  'created_at'=>Carbon::now()->toDateTimeString(),
        //  'updated_at'=>Carbon::now()->toDateTimeString()
        //  ]);
 
        // }
 app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

 // create permissions

   $permission = array("create user","edit user","delete user"
   ,"view users", "view roles" ,"create role","edit role","delete role",
   "view permissions " ,"add permission"
   );

   foreach ($permission as $value) {
      Permission::create(['name' => $value]);
   }
 
 $role = Role::create(['name' => 'super-admin']);
 $role->givePermissionTo(Permission::all());

 
$user = factory(User::class)->create(['name'=>'zeyad sharo' ,'email_verified_at'=>Carbon::now()->toDateTimeString(),
'email'=>'zeyadsharo85@gmail.com','password'=>bcrypt('4325775735')]);
$user->assignRole('super-admin');
    }
}