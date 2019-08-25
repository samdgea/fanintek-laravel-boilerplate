<?php
/**
 * FANINTEK Boilerplate Laravel Project - A Customized Laravel Project Template
 *
 * @package  FANINTEK Boilerplate Laravel
 * @author   Abdilah Sammi <sammy@fanintek.com>
 */

return [
    'roles' => [
        'Administrator',
        'Staff',
        'Employee'
    ],
    'allow_new_registration' => false,
    'new_user_default_role' => 'Employee',
    'super_admin' => 'Administrator', // Set to null if you did not want any roles have all access to routes,
    'allowed_role_access_admin_menu' => [
        'Staff'
    ],
    'menus' => [
        /**
         * For this time menu generator only support 1 child menu
         */
        [
            'label' => 'Dashboard',
            'type' => 'ROUTE_NAME', // menus type must be ROUTE_NAME, ROUTE_ACTION, or URL
            'data' => 'home', // put route link ex: HomeController@index (if you choose ROUTE_ACTION), admin.user.index (if you choose ROUTE_NAME), or link (if you choose URL)
            'icon' => 'fa fa-dashboard', // you could use font-awesome or Ionicons
            'granted_to' => [
                'roles' => [
                    'Staff',
                    'Employee'
                ],
                'users' => []
            ]
        ], [
            'label' => 'Administative Menu',
            'type' => 'URL',
            'data' => '#',
            'icon' => 'fa fa-cogs',
            'granted_to' => [
                'roles' => [
                    'staff'
                ],
                'users' => []
            ],
            'children' => [
                [
                    'label' => 'User Management',
                    'type' => 'URL',
                    'data' => '#user-management',
                    'icon' => 'fa fa-circle-o',
                ], [
                    'label' => 'Role Management',
                    'type' => 'URL',
                    'data' => '#role-management',
                    'icon' => 'fa fa-circle-o'
                ], [
                    'label' => 'Menu Management',
                    'type' => 'URL',
                    'data' => '#menu-management',
                    'icon' => 'fa fa-circle-o'
                ]
            ]
        ]
    ],
    'users' => [
        [
            'first_name' => 'Abdilah',
            'last_name' => 'Sammi',
            'email' => 'ask@abdilah.id',
            'password' => 'password',
            'is_active' => true,
        ]
    ],
    'assign_user_role' => [
        [
            'email' => 'ask@abdilah.id',
            'role' => 'Administrator'
        ]
    ]
];