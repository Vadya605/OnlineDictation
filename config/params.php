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
            'Answer asc' => [
                'sort_column' => 'answer', 
                'sort_option' => 'asc'
            ],
            'Answer desc' => [
                'sort_column' => 'answer', 
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
            'Checked asc' => [
                'sort_column' => 'dictation_results.is_checked', 
                'sort_option' => 'asc'
            ],
            'Checked desc' => [
                'sort_column' => 'dictation_results.is_checked', 
                'sort_option' => 'desc'
            ],
            'Mark asc' => [
                'sort_column' => 'dictation_results.mark', 
                'sort_option' => 'asc'
            ],
            'Mark desc' => [
                'sort_column' => 'dictation_results.mark', 
                'sort_option' => 'desc'
            ],
        ]
    ],
    'filter' => [
        'dictations' => [
            'Active' => [
                'filter_column' => 'is_active',
                'filter_option' => '=',
                'filter_value' => '1'
            ],
            'Not active' => [
                'filter_column' => 'is_active',
                'filter_option' => '=',
                'filter_value' => '0'
            ],
            'With description' => [
                'filter_column' => 'description',
                'filter_option' => 'is not null',
                'filter_value' => null
            ],
            'Without description' => [
                'filter_column' => 'description',
                'filter_option' => 'is null',
                'filter_value' => null
            ],
        ],
        'users' => [
            'Administrators' => [
                'filter_column' => 'role',
                'filter_option' => '=',
                'filter_value' => UserRole::ADMIN
            ],
            'Users' => [
                'filter_column' => 'role',
                'filter_option' => '=',
                'filter_value' => UserRole::USER
            ]
        ],
    ]
];