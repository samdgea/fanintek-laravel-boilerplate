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
    'super_admin' => 'Administrator', // Set to null if you did not want any roles have all access to routes
    'menus' => [
        [
            'label' => 'Dashboard',
            'route' => 'home',
            'icon'  => 'dashboard',
            'granted_to' => [
                'roles' => [
                    'Staff',
                    'Employee'
                ], 
                'users' => [
                    // 'ask@abdilah.id'
                ]
            ], // You can configure later in Menu Management on the app
        ],
        [
            'label' => 'Administrative Menu',
            'url' => '#',
            'icon' => 'cogs',
            'children' => [
                [
                    'label' => 'User Management',
                    'route' => 'admin.user.index',
                    'icon' => 'users', 
                    'granted_to' => [
                        'roles' => [
                            'Staff'
                        ], 
                        'users' => [
                            // 'ask@abdilah.id'
                        ]
                    ]
                ], [
                    'label' => 'Menu Management',
                    'route' => 'admin.menu.index',
                    'icon' => 'tags',
                    'granted_to' => [
                        'roles' => [
                            'Staff'
                        ], 
                        'users' => [
                            // 'ask@abdilah.id'
                        ]
                    ]
                ], [
                    'label' => 'Roles Management',
                    'route' => 'admin.role.index',
                    'icon' => 'users',
                    'granted_to' => [
                        'roles' => [
                            'Staff'
                        ], 
                        'users' => [
                            // 'ask@abdilah.id'
                        ]
                    ]
                ]
            ],
            'granted_to' => [
                'roles' => [
                    'Staff'
                ], 
                'users' => [
                    // 'ask@abdilah.id'
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