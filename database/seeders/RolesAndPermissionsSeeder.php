<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // item
            'manage item',
            'edit item',
            'delete item',
            'add item',
            'view item',
            // kategori
            'manage kategori',
            'create kategori',
            'edit kategori',
            'delete kategori',
            'view kategori',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }


        $admin = Role::create(['name' => 'admin',]);
        $petugas = Role::create(['name' => 'petugas',]);
        $pengunjung = Role::create(['name' => 'pengunjung',]);
        
        $admin->givePermissionTo($permissions);
        $petugas->givePermissionTo([
            'view item',
            'view kategori',
        ]);
        $pengunjung->givePermissionTo([
            'view item',
            'view kategori',
        ]);
    }
}
