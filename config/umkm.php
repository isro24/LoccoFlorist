<?php

return [
    'product_admin_emails' => array_values(array_filter(array_map(
        'trim',
        explode(',', env('PRODUCT_ADMIN_EMAILS', ''))
    ))),

    'whatsapp' => [
        'seller_number' => env('SELLER_WHATSAPP_NUMBER'),
        'seller_banner_number' => env('SELLER_WHATSAPP_BANNER'),
    ],
];
