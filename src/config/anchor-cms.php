<?php

return [
    'deets' => [
        'client_uuid' => env('ANCHOR_CLIENT_ID', '')
    ],
    // You can rename this disk here. Default: root
    'root_disk_name' => 'root',
    'class_maps' => [
        'ad-budgets'   => \CapeAndBay\AnchorCMS\Library\AdOps\Budget::class,
        'ad-markets'   => \CapeAndBay\AnchorCMS\Library\AdOps\Market::class,
        'docking-port' => \CapeAndBay\AnchorCMS\Library\Auth\DockingPort::class
    ],
    'single-sign-on-redirect' => env('ANCHOR_SSO_SUCCESS_ROUTE', '/cms'),
    'cms_driver' => 'backpack', //none is also an option,
    'users_table' => 'App\User'
];
