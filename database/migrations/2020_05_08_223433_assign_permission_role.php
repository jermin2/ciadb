<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Role;
use App\Permission;
use App\User;

class AssignPermissionRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            [ 'name' => 'create_events'],
            [ 'name' => 'show_events'],
            [ 'name' => 'edit_events'],
            [ 'name' => 'delete_events'],
            
            [ 'name' => 'create_people'],
            [ 'name' => 'show_people'],
            [ 'name' => 'edit_people'],
            [ 'name' => 'delete_people'],
            
            [ 'name' => 'show_users'],
            [ 'name' => 'edit_users'],
            [ 'name' => 'delete_users'],

            [ 'name' => 'edit_systemtags'],
            [ 'name' => 'edit_usertags'],

            
            
        ];
        DB::table('permissions')->insert($permissions);

        $roles = [
            ['name' => 'admin'],
            ['name' => 'serving_one'],
            ['name' => 'guest'],  
            ['name' => 'approved'],
            ['name' => 'event_manager'],
            ['name' => 'people_manager'],
            ['name' => 'user_manager'],
            ['name' => 'event_admin'],
            ['name' => 'people_admin'],  
            ['name' => 'user_admin'],
            ['name' => 'tag_admin']         
        ];
        DB::table('roles')->insert($roles);

        //We don't need to assign admin, they can see everything
        $role_permissions = [

            $this->getIds('serving_one', 'create_events'),
            $this->getIds('serving_one', 'show_events'),

            $this->getIds('serving_one', 'create_people'),
            $this->getIds('serving_one', 'show_people'),
            $this->getIds('serving_one', 'edit_people'),
            $this->getIds('serving_one', 'edit_usertags'),

            $this->getIds('approved', 'show_people'),

            $this->getIds('event_manager', 'edit_events'),
            $this->getIds('event_manager', 'create_events'),
            $this->getIds('event_manager', 'show_events'),

            $this->getIds('event_admin', 'delete_events'),

            $this->getIds('people_manager', 'create_people'),
            $this->getIds('people_manager', 'show_people'),
            $this->getIds('people_manager', 'edit_people'),

            $this->getIds('people_admin', 'delete_people'),

            $this->getIds('user_manager', 'show_users'),
            $this->getIds('user_manager', 'edit_users'),

            $this->getIds('user_admin', 'delete_users'),

            $this->getIds('tag_admin', 'edit_systemtags'),
            $this->getIds('tag_admin', 'edit_usertags'),
            
        ];

        DB::table('permission_role')->insert($role_permissions);

        $user = User::create([
            'name' => 'Jermin Tiu',
            'email' => 'jermin2@gmail.com',
            'password' => Hash::make('asdfasdf'),
            'person_id' => 1
        ]);
        $user->markEmailAsVerified();

        //Make the first user an admin (jermin2@gmail.com);
        DB::table('role_user')->insert([
            ['user_id' => '1', 'role_id' => '1']
        ]);
    }

    public function getIds($role_name, $permission_name){
        $role_id = Role::select('id')->where('name', $role_name)->first()->id;
        $permission_id = Permission::select('id')->where('name', $permission_name)->first()->id;

        return ['role_id'=> $role_id, 'permission_id' => $permission_id ];
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permission_role')->truncate();
    }
}
