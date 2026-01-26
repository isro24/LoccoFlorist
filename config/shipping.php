<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Shipping Rates Configuration
    |--------------------------------------------------------------------------
    |
    | Configure shipping rates based on distance ranges for flower board delivery.
    | Rates are in Indonesian Rupiah (IDR).
    |
    */

    'rates' => [
        'free' => 0,           // < 3km - Free shipping for nearby areas
        '5km' => 20000,        // ~5km distance
        '8km' => 30000,        // ~8km distance
        '10km' => 35000,       // ~10km distance
        '17km' => 45000,       // ~17km distance
        '20km' => 55000,       // >20km distance
    ],

    /*
    |--------------------------------------------------------------------------
    | Free Shipping Locations
    |--------------------------------------------------------------------------
    |
    | List of locations that qualify for free shipping (< 3km from workshop)
    |
    */

    'free_locations' => [
        'UMY',
        'Unjaya 2',
        'Almaata',
        'UPY',
        'Amayo',
    ],

    /*
    |--------------------------------------------------------------------------
    | Location Groups
    |--------------------------------------------------------------------------
    |
    | Organize locations by distance for easier management
    |
    */

    'locations' => [
        'free' => [
            ['name' => 'UMY', 'distance' => '< 3km'],
            ['name' => 'Unjaya 2', 'distance' => '< 3km'],
            ['name' => 'Almaata', 'distance' => '< 3km'],
            ['name' => 'UPY', 'distance' => '< 3km'],
            ['name' => 'Amayo', 'distance' => '< 3km'],
        ],
        '5km' => [
            ['name' => 'Unjaya 1', 'distance' => '5km'],
            ['name' => 'Poltekes Kemenkes', 'distance' => '5km'],
        ],
        '8km' => [
            ['name' => 'UAD 1', 'distance' => '8km'],
            ['name' => 'UAD 2', 'distance' => '8km'],
            ['name' => 'UAD 3', 'distance' => '8km'],
            ['name' => 'UAD 4', 'distance' => '8km'],
            ['name' => 'MMTC', 'distance' => '8km'],
            ['name' => 'POLITEKNIK YPKN', 'distance' => '8km'],
            ['name' => 'UKDW', 'distance' => '8km'],
            ['name' => 'ISI', 'distance' => '8km'],
        ],
        '10km' => [
            ['name' => 'UGM', 'distance' => '10km'],
            ['name' => 'UNY', 'distance' => '10km'],
            ['name' => 'USD', 'distance' => '10km'],
            ['name' => 'UII Demangan', 'distance' => '10km'],
            ['name' => 'UIN SUKA', 'distance' => '10km'],
            ['name' => 'UTY 1', 'distance' => '10km'],
            ['name' => 'UTY 2', 'distance' => '10km'],
        ],
        '17km' => [
            ['name' => 'Marcu Buana 3', 'distance' => '17km'],
            ['name' => 'UPN', 'distance' => '17km'],
            ['name' => 'Insiter', 'distance' => '17km'],
            ['name' => 'STIE YKPN', 'distance' => '17km'],
            ['name' => 'Pascasarjana UIN SUKA', 'distance' => '17km'],
        ],
        '20km' => [
            ['name' => 'UII', 'distance' => '>20km'],
            ['name' => 'UNY Wates', 'distance' => '>20km'],
            ['name' => 'Area Lain >20 Km', 'distance' => '>20km'],
        ],
    ],
];
