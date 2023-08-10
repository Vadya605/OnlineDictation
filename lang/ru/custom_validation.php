<?php
return [
    'admin' => [
        '*' => [
            'sort' => [
                'in' => 'Сортировка должна производиться по одному из столбцов таблицы'
            ],
            'filter' => [
                'in' => 'Фильтр должен быть одним из предложенных'
            ],
            'search' => [
                'nullable' => 'Поиск должен быть пустым или содержать строковое значение.',
                'string' => 'Поиск должен быть строкой.',
            ],
            'date_from' => [
                'nullable' => 'Дата от должна быть пустым или иметь формат "дд.мм.гггг чч:мм".',
                'date_format' => 'Дата от должна иметь формат "дд.мм.гггг чч:мм".',
            ],
            'date_to' => [
                'nullable' => 'Дата до должно быть пустым или иметь формат "дд.мм.гггг чч:мм".',
                'date_format' => 'Дата до должно иметь формат "дд.мм.гггг чч:мм".',
                'after_or_equal' => 'Дата до должна быть датой после или равной дате от'
            ],
        ],
        'dictations' => [
            'title' => [
                'required' => 'Название диктанта обязательно для заполнения',
                'string' => 'Название диктанта должно быть строкой',
                'max' => 'Название диктанта должно иметь длинну не боллее 191 символа'
            ],
            'video_link' => [
                'required' => 'Ссылка на видео обязательна для заполнения',
                'active_url' => 'Ссылка на видео должна быть действительной'
            ],
            'is_active' => [
                'nullable' => 'Статус активности дикнта должен быть пустым, истинным или ложным',
                'boolean' => 'Статус активности дикнта должен быть истинным или ложным'
            ],
            'description' => [
                'nullable' => 'Описание диктанта должно быть пустым или строкой',
                'string' => 'Описание диктанта должно быть строкой'
            ],
            'answer' => [
                'required' => 'Ответ диктанта обязателен для заполнения',
                'string' => 'Ответ диктанта должен быть строкой',
            ],
            'from_date_time' => [
                'required' => 'Дата и время начала диктанта обязательна для заполнения',
                'date_format' => 'Дата и время начала диктанта должна иметь формат дд.мм.гггг чч:мм'
            ],
            'to_date_time' => [
                'required' => 'Дата и время окончания диктанта обязательна для заполнения',
                'date_format' => 'Дата и время окончания диктанта должна иметь формат дд.мм.гггг чч:мм',
                'after_or_equal' => 'Дата и время окончания диктанта должна быть датой после или равной дате начала'
            ],  
        ],
        'users' => [
            'name' => [
                'required' => 'Имя пользователя обязательно для заполнения',
                'string' => 'Имя пользователя должно быть строкой',
                'max:191' => 'Имя пользователя должно иметь длинну не боллее 191 символа'
            ],
            'email' => [
                'required' => 'Email пользователя обязателен для заполнения',
                'string' => 'Email пользователя должен быть строкой',
                'email' => 'Email пользователя должен быть действующим email адресом',
                'max:191' => 'Email пользователя должен иметь длинну не боллее 191 символа',
                'unique' => 'Такой email адрес уже занят'
            ],
        ],
        'dictation_results' => [
            'text_result' => [
                'required' => 'Текст диктанта обязателен для заполнения',
                'string' => 'Текст диктанта должен быть строкой',
            ],
            'dictation' => [
                'exists' => 'Такого диктанта не существует'
            ],
            'user' => [
                'exists' => 'Такого диктанта не существует'
            ],
            'user_id' => [
                'required' => 'Id пользователя обязателен для заполнения',
                'unique' => 'Такая запись уже существует'
            ],
            'dictation_id' => [
                'required' => 'Id диктанта обязателен для заполнения',
                'unique' => 'Такая запись уже существует'
            ],
            'date_time_result' => [
                'required' => 'Дата и время написания обязатело для заполнения',
                'date_format' => 'Дата и время написания диктанта должно иметь формат дд.мм.гггг чч:мм',
            ],
            'is_checked' => [
                'required' => 'Статус проверки обязателен для заполнения',
                'boolean' => 'Статус проверки должен быть истинным или ложным'
            ],
            'mark' => [
                'required_if' => 'Отметка обязательна для заполнения, если результат диктанта проверен',
                'integer' => 'Отметка должна быть целым числом'
            ]
        ],
    ],
    'user' => [
        'dictationWriting' => [
            'text_result' => [
                'required' => 'Текст диктанта обязателен для заполнения',
                'string' => 'Текст диктанта должен быть строкой'
            ]
        ]
    ]
];