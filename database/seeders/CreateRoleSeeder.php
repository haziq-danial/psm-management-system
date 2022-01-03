<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // manage title
        Permission::create(['name' => 'add title']);
        Permission::create(['name' => 'delete title']);
        Permission::create(['name' => 'edit title']);
        Permission::create(['name' => 'book title']);
        Permission::create(['name' => 'approve title']);

        // manage proposal
        Permission::create(['name' => 'view all proposals']);
        Permission::create(['name' => 'view proposal']);
        Permission::create(['name' => 'add proposal']);
        Permission::create(['name' => 'delete proposal']);
        Permission::create(['name' => 'edit proposal']);
        Permission::create(['name' => 'set approval proposal']);

        // manage inventory
        Permission::create(['name' => 'view all items']);
        Permission::create(['name' => 'view item']);
        Permission::create(['name' => 'add item']);
        Permission::create(['name' => 'update item']);
        Permission::create(['name' => 'delete item']);
        Permission::create(['name' => 'set approve item']);

        // role student
        $student = Role::create(['name' => 'student']);
        $student->givePermissionTo('book title');
        $student->givePermissionTo('edit title');
        $student->givePermissionTo('view proposal');
        $student->givePermissionTo('edit proposal');
        $student->givePermissionTo('view item');
        $student->givePermissionTo('add item');
        $student->givePermissionTo('update item');
        $student->givePermissionTo('delete item');

        // role supervisor
        $supervisor = Role::create(['name' => 'supervisor']);
        $supervisor->givePermissionTo('add title');
        $supervisor->givePermissionTo('edit title');
        $supervisor->givePermissionTo('delete title');
        $supervisor->givePermissionTo('view all proposals');
        $supervisor->givePermissionTo('delete proposal');
        $supervisor->givePermissionTo('edit proposal');

        // rolw coordinator
        $coordinator = Role::create(['name' => 'coordinator']);
        $coordinator->givePermissionTo('view all proposals');
        $coordinator->givePermissionTo('set approval proposal');

        $technician = Role::create(['name' => 'technician']);
        $technician->givePermissionTo('set approve item');
        $technician->givePermissionTo('view all items');
    }
}
