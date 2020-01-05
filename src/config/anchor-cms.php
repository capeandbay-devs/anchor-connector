<?php

return [
    'deets' => [
        'client_uuid' => env('ANCHOR_CLIENT_ID', '')
    ],
    // You can rename this disk here. Default: root
    'root_disk_name' => 'root',
    'class_maps' => [
        'ad-budgets' => \CapeAndBay\AnchorCMS\Library\AdOps\Budget::class,
        'ad-markets' => \CapeAndBay\AnchorCMS\Library\AdOps\Market::class
    ]
];
