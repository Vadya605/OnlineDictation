<?php
use App\Enums\User\UserRole;

return [
    'sort' => [
        'dictations' => [
            'Id asc' => [
                'sort_column' => 'id', 
                'sort_option' => 'asc'
            ],
            'Id desc' => [
                'sort_column' => 'id', 
                'sort_option' => 'desc'
            ],
            'Title asc' => [
                'sort_column' => 'title', 
                'sort_option' => 'asc'
            ],
            'Title desc' => [
                'sort_column' => 'title', 
                'sort_option' => 'desc'
            ],
            'Video asc' => [
                'sort_column' => 'video_link', 
                'sort_option' => 'asc'
            ],
            'Video desc' => [
                'sort_column' => 'video_link', 
                'sort_option' => 'desc'
            ],
            'Active asc' => [
                'sort_column' => 'is_active', 
                'sort_option' => 'asc'
            ],
            'Active desc' => [
                'sort_column' => 'is_active', 
                'sort_option' => 'desc'
            ],
            'Description asc' => [
                'sort_column' => 'description', 
                'sort_option' => 'asc'
            ],
            'Description desc' => [
                'sort_column' => 'description', 
                'sort_option' => 'desc'
            ],
            'Beginning asc' => [
                'sort_column' => 'from_date_time', 
                'sort_option' => 'asc'
            ],
            'Beginning desc' => [
                'sort_column' => 'from_date_time', 
                'sort_option' => 'desc'
            ],
            'Ending asc' => [
                'sort_column' => 'to_date_time', 
                'sort_option' => 'asc'
            ],
            'Ending desc' => [
                'sort_column' => 'to_date_time', 
                'sort_option' => 'desc'
            ],
            'Creation asc' => [
                'sort_column' => 'created_at', 
                'sort_option' => 'asc'
            ],
            'Creation desc' => [
                'sort_column' => 'created_at', 
                'sort_option' => 'desc'
            ],
        ],
        'users' => [
            'Id asc' => [
                'sort_column' => 'id', 
                'sort_option' => 'asc'
            ],
            'Id desc' => [
                'sort_column' => 'id', 
                'sort_option' => 'desc'
            ],
            'Name asc' => [
                'sort_column' => 'name', 
                'sort_option' => 'asc'
            ],
            'Name desc' => [
                'sort_column' => 'name', 
                'sort_option' => 'desc'
            ],
            'Email asc' => [
                'sort_column' => 'email', 
                'sort_option' => 'asc'
            ],
            'Email desc' => [
                'sort_column' => 'Email', 
                'sort_option' => 'desc'
            ],
            'Role asc' => [
                'sort_column' => 'role', 
                'sort_option' => 'asc'
            ],
            'Role desc' => [
                'sort_column' => 'role', 
                'sort_option' => 'desc'
            ],
            'Registration asc' => [
                'sort_column' => 'created_at', 
                'sort_option' => 'asc'
            ],
            'Registration desc' => [
                'sort_column' => 'created_at', 
                'sort_option' => 'desc'
            ],
        ],
        'dictationResults' => [
            'Id asc' => [
                'sort_column' => 'dictation_results.id', 
                'sort_option' => 'asc'
            ],
            'Id desc' => [
                'sort_column' => 'dictation_results.id', 
                'sort_option' => 'desc'
            ],
            'User asc' => [
                'sort_column' => 'users.name', 
                'sort_option' => 'asc'
            ],
            'User desc' => [
                'sort_column' => 'users.name', 
                'sort_option' => 'desc'
            ],
            'Email asc' => [
                'sort_column' => 'users.email', 
                'sort_option' => 'asc'
            ],
            'Email desc' => [
                'sort_column' => 'users.email', 
                'sort_option' => 'desc'
            ],
            'Dictation asc' => [
                'sort_column' => 'dictations.title', 
                'sort_option' => 'asc'
            ],
            'Dictation desc' => [
                'sort_column' => 'dictations.title', 
                'sort_option' => 'desc'
            ],
            'Text asc' => [
                'sort_column' => 'dictation_results.text_result', 
                'sort_option' => 'asc'
            ],
            'Text desc' => [
                'sort_column' => 'dictation_results.text_result', 
                'sort_option' => 'desc'
            ],
            'Written asc' => [
                'sort_column' => 'dictation_results.date_time_result', 
                'sort_option' => 'asc'
            ],
            'Written desc' => [
                'sort_column' => 'dictation_results.date_time_result', 
                'sort_option' => 'desc'
            ],
        ]
    ],
    'filter' => [
        'dictations' => [
            'Активные' => [
                'filter_column' => 'is_active',
                'filter_option' => '=',
                'filter_value' => '1'
            ],
            'Не активные' => [
                'filter_column' => 'is_active',
                'filter_option' => '=',
                'filter_value' => '0'
            ],
            'С видео' => [
                'filter_column' => 'video_link',
                'filter_option' => 'is not null',
                'filter_value' => null
            ],
            'Без видео' => [
                'filter_column' => 'video_link',
                'filter_option' => 'is null',
                'filter_value' => null
            ],
            'С датой начала' => [
                'filter_column' => 'from_date_time',
                'filter_option' => 'is not null',
                'filter_value' => null
            ],
            'Без даты начала' => [
                'filter_column' => 'from_date_time',
                'filter_option' => 'is null',
                'filter_value' => null
            ],
            'С датой окончания' => [
                'filter_column' => 'to_date_time',
                'filter_option' => 'is not null',
                'filter_value' => null
            ],
            'Без даты окончания' => [
                'filter_column' => 'to_date_time',
                'filter_option' => 'is null',
                'filter_value' => null
            ],
            'С описанием' => [
                'filter_column' => 'description',
                'filter_option' => 'is not null',
                'filter_value' => null
            ],
            'Без описания' => [
                'filter_column' => 'description',
                'filter_option' => 'is null',
                'filter_value' => null
            ],
        ],
        'users' => [
            'Администраторы' => [
                'filter_column' => 'role',
                'filter_option' => '=',
                'filter_value' => UserRole::ADMIN
            ],
            'Пользователи' => [
                'filter_column' => 'role',
                'filter_option' => '=',
                'filter_value' => UserRole::USER
            ]
        ],
    ]
];