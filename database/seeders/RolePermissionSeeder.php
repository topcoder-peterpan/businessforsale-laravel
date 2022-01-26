<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Create roles
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);

        //  permission List as array
        $permissions = [
            [
                'group_name' => 'admin',
                'permissions' => [
                    // Admin permission
                    'admin.create',
                    'admin.view',
                    'admin.update',
                    'admin.delete',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // Role permission
                    'role.create',
                    'role.view',
                    'role.update',
                    'role.delete',
                ]
            ],
            [
                'group_name' => 'ad',
                'permissions' => [
                    // Ad permission
                    'ad.create',
                    'ad.view',
                    'ad.update',
                    'ad.delete',
                ]
            ],
            [
                'group_name' => 'category',
                'permissions' => [
                    // Category permission
                    'category.create',
                    'category.view',
                    'category.update',
                    'category.delete',
                    'subcategory.create',
                    'subcategory.view',
                    'subcategory.update',
                    'subcategory.delete',
                ]
            ],
            [
                'group_name' => 'newsletter',
                'permissions' => [
                    // Category permission
                    'newsletter.view',
                    'newsletter.mailsend',
                    'newsletter.delete',
                ]
            ],
            [
                'group_name' => 'brand',
                'permissions' => [
                    // Brand permission
                    'brand.create',
                    'brand.view',
                    'brand.update',
                    'brand.delete',
                ]
            ],
            [
                'group_name' => 'Location',
                'permissions' => [
                    // Location permission
                    'city.create',
                    'city.view',
                    'city.update',
                    'city.delete',
                    'town.create',
                    'town.view',
                    'town.update',
                    'town.delete',
                ]
            ],
            [
                'group_name' => 'plan',
                'permissions' => [
                    // Role permission
                    'plan.create',
                    'plan.view',
                    'plan.update',
                    'plan.delete',
                ]
            ],
            [
                'group_name' => 'Blog',
                'permissions' => [
                    // Role permission
                    'post.create',
                    'post.view',
                    'post.update',
                    'post.delete',
                    'tag.create',
                    'tag.view',
                    'tag.update',
                    'tag.delete',
                ]
            ],
            [
                'group_name' => 'testimonial',
                'permissions' => [
                    // Role permission
                    'testimonial.create',
                    'testimonial.view',
                    'testimonial.update',
                    'testimonial.delete',
                ]
            ],
            [
                'group_name' => 'faq',
                'permissions' => [
                    // Role permission
                    'faqcategory.create',
                    'faqcategory.view',
                    'faqcategory.update',
                    'faqcategory.delete',
                    'faq.create',
                    'faq.view',
                    'faq.update',
                    'faq.delete',
                ]
            ],
            [
                'group_name' => 'others',
                'permissions' => [
                    // Role permission
                    'customer.view',
                    'setting.view',
                    'setting.update',
                    'contact.view',
                ]
            ],
        ];

        // Assaign Permission
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];

            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
    }
}
