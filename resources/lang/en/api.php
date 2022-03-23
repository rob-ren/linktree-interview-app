<?php

return [
    'error' => [
        'links' => [
            'by_user_id' => [
                'missing' => [
                    'user_id' => 'Could not establish api without user id from the incoming request',
                ]
            ]
        ],
        'link' => [
            'create' => [
                'classic_missing_key'  => 'The input field is missing',
                'classic_invalid_data' => 'The input field data is invalid',
                'music_missing_key'    => 'The input field for Link Music is missing',
                'shows_missing_key'    => 'The input field for Link Shows is missing',
                'shows_invalid_data'   => 'The input field for Link Shows data is invalid',
            ]
        ]
    ],
    'response' => [
        'codes' => [
            'success'   => '200',
            'not_found' => '404',
            'forbidden' => '403',
        ],
        'message' => [
            'success' => 'Success'
        ]
    ]
];
