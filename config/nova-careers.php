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
    | Application Email
    |--------------------------------------------------------------------------
    |
    | This value is the email address that careers applications will be sent
    | to.
    |
    */
    'application_email' => env('CAREERS_EMAIL', ''),

    /*
    |--------------------------------------------------------------------------
    | Excluded Blocks
    |--------------------------------------------------------------------------
    |
    | List of block names to be excluded from the page builder.
    |
    */
    'excluded_blocks' => [],

    /*
    |--------------------------------------------------------------------------
    | Traffic Cop
    |--------------------------------------------------------------------------
    |
    | Indicates whether Nova should check for modifications between viewing and updating a resource.
    |
    */
    'trafficCop' => false,
];
