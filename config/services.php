<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    "google" => [
        "client_id" => env("GOOGLE_CLIENT_ID"),
        'client_secret' => env("GOOGLE_CLIENT_SECRET"),
        'redirect' => '/auth/google/callback'
    ],

    "github" => [
        "client_id" => env("GITHUB_CLIENT_ID"),
        "client_secret" => env("GITHUB_CLIENT_SECRET"),
        "redirect" => "/auth/github/callback"
    ],

    "slack" => [
        "client_id" => env("SLACK_CLIENT_ID"),
        "client_secret" => env("SLACK_CLIENT_SECRET"),
        "redirect" => "auth/slack/callback"
    ],

    "facebook" => [
        "client_id" => env("META_CLIENT_ID"),
        "client_secret" => env("META_CLIENT_SECRET"),
        "redirect" => "auth/meta/callback"
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
