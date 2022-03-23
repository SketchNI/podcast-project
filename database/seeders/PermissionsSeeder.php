<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['guard_name' => 'web', 'name' => 'admin.settings']);
        Permission::create(['guard_name' => 'web', 'name' => 'admin.view']);
        Permission::create(['guard_name' => 'web', 'name' => 'admin.update']);
        Permission::create(['guard_name' => 'web', 'name' => 'admin.sensitive']);
        Permission::create(['guard_name' => 'web', 'name' => 'admin.horizon']);
        Permission::create(['guard_name' => 'web', 'name' => 'admin.logs']);

        Permission::create(['guard_name' => 'web', 'name' => 'podcast.self.create']);
        Permission::create(['guard_name' => 'web', 'name' => 'podcast.self.read']);
        Permission::create(['guard_name' => 'web', 'name' => 'podcast.self.update']);
        Permission::create(['guard_name' => 'web', 'name' => 'podcast.self.delete']);

        Permission::create(['guard_name' => 'web', 'name' => 'podcast.all.create']);
        Permission::create(['guard_name' => 'web', 'name' => 'podcast.all.read']);
        Permission::create(['guard_name' => 'web', 'name' => 'podcast.all.update']);
        Permission::create(['guard_name' => 'web', 'name' => 'podcast.all.delete']);

        Permission::create(['guard_name' => 'web', 'name' => 'user.all.create']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.all.read']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.all.update']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.all.delete']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.all.links']);

        Permission::create(['guard_name' => 'web', 'name' => 'user.self.create']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.self.read']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.self.update']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.self.delete']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.self.links']);

        Permission::create(['guard_name' => 'web', 'name' => 'user.all.bio.create']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.all.bio.read']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.all.bio.update']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.all.bio.delete']);

        Permission::create(['guard_name' => 'web', 'name' => 'user.self.bio.create']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.self.bio.read']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.self.bio.update']);
        Permission::create(['guard_name' => 'web', 'name' => 'user.self.bio.delete']);

        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin'])
            ->givePermissionTo('admin.settings')
            ->givePermissionTo('admin.view')
            ->givePermissionTo('admin.update')
            ->givePermissionTo('admin.sensitive')
            ->givePermissionTo('admin.horizon')
            ->givePermissionTo('admin.logs')

            ->givePermissionTo('podcast.self.create')
            ->givePermissionTo('podcast.self.read')
            ->givePermissionTo('podcast.self.update')
            ->givePermissionTo('podcast.self.delete')

            ->givePermissionTo('podcast.all.create')
            ->givePermissionTo('podcast.all.read')
            ->givePermissionTo('podcast.all.update')
            ->givePermissionTo('podcast.all.delete')

            ->givePermissionTo('user.all.create')
            ->givePermissionTo('user.all.read')
            ->givePermissionTo('user.all.update')
            ->givePermissionTo('user.all.delete')
            ->givePermissionTo('user.all.links')

            ->givePermissionTo('user.self.create')
            ->givePermissionTo('user.self.read')
            ->givePermissionTo('user.self.update')
            ->givePermissionTo('user.self.delete')
            ->givePermissionTo('user.self.links')

            ->givePermissionTo('user.all.bio.create')
            ->givePermissionTo('user.all.bio.read')
            ->givePermissionTo('user.all.bio.update')
            ->givePermissionTo('user.all.bio.delete')

            ->givePermissionTo('user.self.bio.create')
            ->givePermissionTo('user.self.bio.read')
            ->givePermissionTo('user.self.bio.update')
            ->givePermissionTo('user.self.bio.delete');

        Role::create(['name' => 'Host'])
            ->givePermissionTo('podcast.self.create')
            ->givePermissionTo('podcast.self.read')
            ->givePermissionTo('podcast.self.update')
            ->givePermissionTo('podcast.self.delete')

            ->givePermissionTo('podcast.all.create')
            ->givePermissionTo('podcast.all.read')
            ->givePermissionTo('podcast.all.update')
            ->givePermissionTo('podcast.all.delete')

            ->givePermissionTo('user.all.create')
            ->givePermissionTo('user.all.read')
            ->givePermissionTo('user.all.update')
            ->givePermissionTo('user.all.delete')
            ->givePermissionTo('user.all.links')

            ->givePermissionTo('user.self.create')
            ->givePermissionTo('user.self.read')
            ->givePermissionTo('user.self.update')
            ->givePermissionTo('user.self.delete')
            ->givePermissionTo('user.self.links')

            ->givePermissionTo('user.all.bio.create')
            ->givePermissionTo('user.all.bio.read')
            ->givePermissionTo('user.all.bio.update')
            ->givePermissionTo('user.all.bio.delete')

            ->givePermissionTo('user.self.bio.create')
            ->givePermissionTo('user.self.bio.read')
            ->givePermissionTo('user.self.bio.update')
            ->givePermissionTo('user.self.bio.delete');

        Role::create(['name' => 'Guest'])
            ->givePermissionTo('podcast.self.create')
            ->givePermissionTo('podcast.self.read')
            ->givePermissionTo('podcast.self.update')
            ->givePermissionTo('podcast.self.delete')
            ->givePermissionTo('user.self.create')
            ->givePermissionTo('user.self.read')
            ->givePermissionTo('user.self.update')
            ->givePermissionTo('user.self.delete')
            ->givePermissionTo('user.self.links')

            ->givePermissionTo('user.self.bio.create')
            ->givePermissionTo('user.self.bio.read')
            ->givePermissionTo('user.self.bio.update')
            ->givePermissionTo('user.self.bio.delete');

        Role::create(['name' => 'Recurring Guest'])
            ->givePermissionTo('podcast.self.create')
            ->givePermissionTo('podcast.self.read')
            ->givePermissionTo('podcast.self.update')
            ->givePermissionTo('podcast.self.delete')
            ->givePermissionTo('user.self.create')
            ->givePermissionTo('user.self.read')
            ->givePermissionTo('user.self.update')
            ->givePermissionTo('user.self.delete')
            ->givePermissionTo('user.self.links')

            ->givePermissionTo('user.self.bio.create')
            ->givePermissionTo('user.self.bio.read')
            ->givePermissionTo('user.self.bio.update')
            ->givePermissionTo('user.self.bio.delete');

        Role::create(['name' => 'Follower'])
            ->givePermissionTo('podcast.self.create')
            ->givePermissionTo('user.self.create')
            ->givePermissionTo('user.self.read')
            ->givePermissionTo('user.self.update')
            ->givePermissionTo('user.self.delete')
            ->givePermissionTo('user.self.links')

            ->givePermissionTo('user.self.bio.create')
            ->givePermissionTo('user.self.bio.read')
            ->givePermissionTo('user.self.bio.update')
            ->givePermissionTo('user.self.bio.delete');
    }
}
