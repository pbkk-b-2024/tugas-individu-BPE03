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
            // keranjang
            'manage keranjang',
            'view keranjang',
            // wishlist
            'manage wishlist',
            'view wishlist',
            // order
            'manage order',
            'view order',
            // user
            'manage user',
            'view user',
            'edit user',
            // review
            'manage review',
            'view review',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }


        $admin = Role::create(['name' => 'admin',]);
        $pembeli = Role::create(['name' => 'pembeli',]);
        $penjual = Role::create(['name' => 'penjual',]);
        
        $admin->givePermissionTo($permissions);
        $pembeli->givePermissionTo([
            'view item',
            'view kategori',
        ]);
        $penjual->givePermissionTo([
            'view item',
            'view kategori',
        ]);
    }
}
