<?php


namespace App\Helpers;


class MenuHelper
{
    public static function getMenu()
    {

        $menu = [
            'dashboard' => [
                'label' => 'Dashboard',
                'icon' => 'fa fa-tachometer',
                'route_name' => 'admin.dashboard',
//                'child_route_name' => [
//                    'admin.dashboard'
//                ],
            ],
//
//            'orders' => [
//                'label' => 'Đơn hàng',
//                'icon' => 'icon icon-speedometer',
//                'route_name' => 'admin.orders.index',
//                'child_route_name' => [
//                    'admin.orders.index',
//                    'admin.orders.edit',
//                ],
//            ],
            self::getAdmin(),
            self::getAdminGroup(),
            self::getGroupPrimary(),
            self::getGroupSecondary(),
            self::getErrorGroup(),
            self::getError(),
            self::getHandle(),
            self::getProductStatus(),
            self::getBranch(),
            self::getGift(),

        ];
        return $menu;
    }
    public static function getBranch()
    {
        return [
            'label' => 'Trạm, TTBH',
            'icon' => 'fa fa-wrench',
            'child_route_name' => [
                'admin.branches.index',
                'admin.branches.create',
                'admin.branches.edit',
            ],
            'sub_menu' => [
                [
                    'label' => 'Danh sách',
                    'icon' => 'fa fa-list',
                    'route_name' => 'admin.branches.index',
                    'child_route_name' => [
                        'admin.branches.index',
                        'admin.branches.edit'
                    ]
                ],
                [
                    'label' => 'Tạo mới',
                    'icon' => 'fa fa-plus',
                    'route_name' => 'admin.branches.create',
                    'child_route_name' => [
                        'admin.branches.create',
                    ]
                ],
            ]
        ];
    }

    public static function getErrorGroup()
    {
        return [
            'label' => 'Nhóm lỗi',
            'icon' => 'fa fa-wrench',
            'child_route_name' => [
                'admin.error-groups.index',
                'admin.error-groups.create',
                'admin.error-groups.edit',
            ],
            'sub_menu' => [
                [
                    'label' => 'Danh sách',
                    'icon' => 'fa fa-list',
                    'route_name' => 'admin.error-groups.index',
                    'child_route_name' => [
                        'admin.error-groups.index',
                        'admin.error-groups.edit'
                    ]
                ],
                [
                    'label' => 'Tạo mới',
                    'icon' => 'fa fa-plus',
                    'route_name' => 'admin.error-groups.create',
                    'child_route_name' => [
                        'admin.error-groups.create',
                    ]
                ],
            ]
        ];
    }

    public static function getProductStatus()
    {
        return [
            'label' => 'Tình trạng ghi nhận',
            'icon' => 'fa fa-wrench',
            'child_route_name' => [
                'admin.product-statuses.index',
                'admin.product-statuses.create',
                'admin.product-statuses.edit',
            ],
            'sub_menu' => [
                [
                    'label' => 'Danh sách',
                    'icon' => 'fa fa-list',
                    'route_name' => 'admin.product-statuses.index',
                    'child_route_name' => [
                        'admin.product-statuses.index',
                        'admin.product-statuses.edit'
                    ]
                ],
                [
                    'label' => 'Tạo mới',
                    'icon' => 'fa fa-plus',
                    'route_name' => 'admin.product-statuses.create',
                    'child_route_name' => [
                        'admin.product-statuses.create',
                    ]
                ],
            ]
        ];
    }


    public static function getGroupSecondary()
    {
        return [
            'label' => 'Nhóm phụ',
            'icon' => 'fa fa-wrench',
            'child_route_name' => [
                'admin.group-secondaries.index',
                'admin.group-secondaries.create',
                'admin.group-secondaries.edit',
            ],
            'sub_menu' => [
                [
                    'label' => 'Danh sách',
                    'icon' => 'fa fa-list',
                    'route_name' => 'admin.group-secondaries.index',
                    'child_route_name' => [
                        'admin.group-secondaries.index',
                        'admin.group-secondaries.edit'
                    ]
                ],
                [
                    'label' => 'Tạo mới',
                    'icon' => 'fa fa-plus',
                    'route_name' => 'admin.group-secondaries.create',
                    'child_route_name' => [
                        'admin.group-secondaries.create',
                    ]
                ],
            ]
        ];
    }

    public static function getGroupPrimary()
    {
        return [
            'label' => 'Nhóm chính',
            'icon' => 'fa fa-wrench',
            'child_route_name' => [
                'admin.group-primaries.index',
                'admin.group-primaries.create',
                'admin.group-primaries.edit',
            ],
            'sub_menu' => [
                [
                    'label' => 'Danh sách',
                    'icon' => 'fa fa-list',
                    'route_name' => 'admin.group-primaries.index',
                    'child_route_name' => [
                        'admin.group-primaries.index',
                        'admin.group-primaries.edit'
                    ]
                ],
                [
                    'label' => 'Tạo mới',
                    'icon' => 'fa fa-plus',
                    'route_name' => 'admin.group-primaries.create',
                    'child_route_name' => [
                        'admin.group-primaries.create',
                    ]
                ],
            ]
        ];
    }

    public static function getAdmin()
    {
        return [
            'label' => 'Nhân viên',
            'icon' => 'fa fa-user',
            'child_route_name' => [
                'admin.admins.index',
                'admin.admins.create',
                'admin.admins.edit',
            ],
            'sub_menu' => [
                [
                    'label' => 'Danh sách',
                    'icon' => 'fa fa-list',
                    'route_name' => 'admin.admins.index',
                    'child_route_name' => [
                        'admin.admins.index',
                        'admin.admins.edit'
                    ]
                ],
                [
                    'label' => 'Tạo mới',
                    'icon' => 'fa fa-plus',
                    'route_name' => 'admin.admins.create',
                    'child_route_name' => [
                        'admin.admins.create',
                    ]
                ],
            ]
        ];
    }

    public static function getError()
    {
        return [
            'label' => 'Lỗi',
            'icon' => 'fa fa-wrench',
            'child_route_name' => [
                'admin.errors.index',
                'admin.errors.create',
                'admin.errors.edit',
            ],
            'sub_menu' => [
                [
                    'label' => 'Danh sách',
                    'icon' => 'fa fa-list',
                    'route_name' => 'admin.errors.index',
                    'child_route_name' => [
                        'admin.errors.index',
                        'admin.errors.edit'
                    ]
                ],
                [
                    'label' => 'Tạo mới',
                    'icon' => 'fa fa-plus',
                    'route_name' => 'admin.errors.create',
                    'child_route_name' => [
                        'admin.errors.create',
                    ]
                ],
            ]
        ];
    }

    public static function getHandle()
    {
        return [
            'label' => 'Cách xử lý',
            'icon' => 'fa fa-wrench',
            'child_route_name' => [
                'admin.handles.index',
                'admin.handles.create',
                'admin.handles.edit',
            ],
            'sub_menu' => [
                [
                    'label' => 'Danh sách',
                    'icon' => 'fa fa-list',
                    'route_name' => 'admin.handles.index',
                    'child_route_name' => [
                        'admin.handles.index',
                        'admin.handles.edit'
                    ]
                ],
                [
                    'label' => 'Tạo mới',
                    'icon' => 'fa fa-plus',
                    'route_name' => 'admin.handles.create',
                    'child_route_name' => [
                        'admin.handles.create',
                    ]
                ],
            ]
        ];
    }

    public static function getAdminGroup()
    {
        return [
            'label' => 'Nhóm nhân viên',
            'icon' => 'fa fa-users',
            'child_route_name' => [
                'admin.admin-groups.index',
                'admin.admin-groups.create',
                'admin.admin-groups.edit',
            ],
            'sub_menu' => [
                [
                    'label' => 'Danh sách',
                    'icon' => 'fa fa-list',
                    'route_name' => 'admin.admin-groups.index',
                    'child_route_name' => [
                        'admin.admin-groups.index',
                        'admin.admin-groups.edit'
                    ]
                ],
                [
                    'label' => 'Tạo mới',
                    'icon' => 'fa fa-plus',
                    'route_name' => 'admin.admin-groups.create',
                    'child_route_name' => [
                        'admin.admin-groups.create',
                    ]
                ],
            ]
        ];
    }
// add gift to menu

    public static function getGift()
    {
        return [
            'label' => 'Hàng tặng',
            'icon' => 'fa fa-gift',
            'child_route_name' => [
                'admin.gifts.index',
                'admin.gifts.create',
                'admin.gifts.edit',
            ],
            'sub_menu' => [
                [
                    'label' => 'Danh sách',
                    'icon' => 'fa fa-list',
                    'route_name' => 'admin.gifts.index',
                    'child_route_name' => [
                        'admin.gifts.index',
                        'admin.gifts.edit'
                    ]
                ],
                [
                    'label' => 'Tạo mới',
                    'icon' => 'fa fa-plus',
                    'route_name' => 'admin.gifts.create',
                    'child_route_name' => [
                        'admin.gifts.create',
                    ]
                ],
            ]
        ];
    }
}
