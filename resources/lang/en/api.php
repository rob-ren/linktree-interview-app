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
        'data' => [
            'malformed' => 'The data provided is malformed',
        ],
        'missing' => [
            'context_identifier'    => 'Could not establish the %s from the incoming request',
            'source'                => 'A source for the api has not been set',
            'default_error_message' => 'A default error message for the api has not been set',
        ]
    ]
];
