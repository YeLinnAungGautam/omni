<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            // 'subcategory-list',
            // 'subcategory-create',
            // 'subcategory-edit',
            // 'subcategory-delete',
            'banner-list',
            'banner-create',
            'banner-edit',
            'banner-delete',
            'slider-list',
            'slider-create',
            'slider-edit',
            'slider-delete',
            'brand-list',
            'brand-create',
            'brand-edit',
            'brand-delete',
            'aboutus-list',
            'aboutus-create',
            'aboutus-edit',
            'about-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'sitesetting-list',
            'sitesetting-create',
            'sitesetting-edit',
            'sitesetting-delete',
            'privacy-list',
            'privacy-create',
            'privacy-edit',
            'privacy-delete',
            'percent-list',
            'percent-create',
            'percent-edit',
            'percent-delete',

         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
