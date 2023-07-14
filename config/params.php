<?php
use App\Enums\User\UserRole;

return [
    'sort' => [
        'dictations' => [
            'Id ув' => [
                'sort_column' => 'id', 
                'sort_option' => 'asc'
            ],
            'Id уб' => [
                'sort_column' => 'id', 
                'sort_option' => 'desc'
            ],
            'Название ув' => [
                'sort_column' => 'title', 
                'sort_option' => 'asc'
            ],
            'Название уб' => [
                'sort_column' => 'title', 
                'sort_option' => 'desc'
            ],
            'Видео ув' => [
                'sort_column' => 'video_link', 
                'sort_option' => 'asc'
            ],
            'Видео уб' => [
                'sort_column' => 'video_link', 
                'sort_option' => 'desc'
            ],
            'Активен ув' => [
                'sort_column' => 'is_active', 
                'sort_option' => 'asc'
            ],
            'Активен уб' => [
                'sort_column' => 'is_active', 
                'sort_option' => 'desc'
            ],
            'Описание ув' => [
                'sort_column' => 'description', 
                'sort_option' => 'asc'
            ],
            'Описание уб' => [
                'sort_column' => 'description', 
                'sort_option' => 'desc'
            ],
            'Начало ув' => [
                'sort_column' => 'from_date_time', 
                'sort_option' => 'asc'
            ],
            'Начало уб' => [
                'sort_column' => 'from_date_time', 
                'sort_option' => 'desc'
            ],
            'Окончание ув' => [
                'sort_column' => 'to_date_time', 
                'sort_option' => 'asc'
            ],
            'Окончание уб' => [
                'sort_column' => 'to_date_time', 
                'sort_option' => 'desc'
            ],
            'Дата создания ув' => [
                'sort_column' => 'created_at', 
                'sort_option' => 'asc'
            ],
            'Дата создания уб' => [
                'sort_column' => 'created_at', 
                'sort_option' => 'desc'
            ],
        ],
        'users' => [
            'Id ув' => [
                'sort_column' => 'id', 
                'sort_option' => 'asc'
            ],
            'Id уб' => [
                'sort_column' => 'id', 
                'sort_option' => 'desc'
            ],
            'Имя ув' => [
                'sort_column' => 'name', 
                'sort_option' => 'asc'
            ],
            'Имя уб' => [
                'sort_column' => 'name', 
                'sort_option' => 'desc'
            ],
            'Email ув' => [
                'sort_column' => 'email', 
                'sort_option' => 'asc'
            ],
            'Email уб' => [
                'sort_column' => 'Email', 
                'sort_option' => 'desc'
            ],
            'Роль ув' => [
                'sort_column' => 'role', 
                'sort_option' => 'asc'
            ],
            'Роль уб' => [
                'sort_column' => 'role', 
                'sort_option' => 'desc'
            ],
            'Дата регистрации ув' => [
                'sort_column' => 'created_at', 
                'sort_option' => 'asc'
            ],
            'Дата регистрации уб' => [
                'sort_column' => 'created_at', 
                'sort_option' => 'desc'
            ],
        ],
        'dictationResults' => [
            'Id ув' => [
                'sort_column' => 'dictation_results.id', 
                'sort_option' => 'asc'
            ],
            'Id уб' => [
                'sort_column' => 'dictation_results.id', 
                'sort_option' => 'desc'
            ],
            'Пользователь ув' => [
                'sort_column' => 'users.name', 
                'sort_option' => 'asc'
            ],
            'Пользователь уб' => [
                'sort_column' => 'users.name', 
                'sort_option' => 'desc'
            ],
            'Email пользователя ув' => [
                'sort_column' => 'users.email', 
                'sort_option' => 'asc'
            ],
            'Email пользователя уб' => [
                'sort_column' => 'users.email', 
                'sort_option' => 'desc'
            ],
            'Диктант ув' => [
                'sort_column' => 'dictations.title', 
                'sort_option' => 'asc'
            ],
            'Диктант уб' => [
                'sort_column' => 'dictations.title', 
                'sort_option' => 'desc'
            ],
            'Текст диктанта ув' => [
                'sort_column' => 'dictation_results.text_result', 
                'sort_option' => 'asc'
            ],
            'Текст диктанта уб' => [
                'sort_column' => 'dictation_results.text_result', 
                'sort_option' => 'desc'
            ],
            'Дата и время написания ув' => [
                'sort_column' => 'dictation_results.date_time_result', 
                'sort_option' => 'asc'
            ],
            'Дата и время написания уб' => [
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