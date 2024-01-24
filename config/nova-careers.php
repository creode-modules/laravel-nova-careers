<?php

// config for Creode/LaravelNovaCareers
return [

    /*
    |--------------------------------------------------------------------------
    | Job Types
    |--------------------------------------------------------------------------
    |
    | Job types that can be selected with each job posting.
    |
    */
    'job_types' => [
        'Full Time' => 'Full Time',
        'Part Time' => 'Part Time',
        'Contract' => 'Contract',
        'Freelance' => 'Freelance',
        'Internship' => 'Internship',
        'Temporary' => 'Temporary',
        'Volunteer' => 'Volunteer',
        'Apprenticeship' => 'Apprenticeship',
    ],

    /*
    |--------------------------------------------------------------------------
    | Careers Email
    |--------------------------------------------------------------------------
    |
    | This value is the email address that careers applications will be sent
    | to.
    |
    */
    'email' => env('CAREERS_EMAIL', ''),

    /*
    |--------------------------------------------------------------------------
    | Excluded Blocks
    |--------------------------------------------------------------------------
    |
    | List of block names to be excluded from the page builder.
    |
    */
    'excluded_blocks' => [
        'imageWithText',
    ]
];
