<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'gcs' => [
            'driver' => 'gcs',
            'key_file_path' => env('GOOGLE_CLOUD_KEY_FILE', null), // optional: /path/to/service-account.json
            'key_file' => [
                'type' => 'service_account',
                'project_id' => 'bold-crossbar-358907',
                'private_key_id' => '53bd26f35ae11dd69c3b0d9535e8d927bd299a8b',
                'private_key' => '-----BEGIN PRIVATE KEY-----
              MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDidqGw4VnOsC/n
              nvxsje0mh+Y7ICYrnD3euBWU4wgmbZdmE3sQYFJHB5YJWnlNLu564V/983/i6bEh
              bWf9VdWnXcfo1g6xwrDEF6BmGFQ7dBQ6xGClg4sAi0tJ3HedGppHJxjYgXl4GHXw
              5wCMIMEP2RhY7z7Ud1AgGUY+1escRcLhqSn3apGtVegqUGnwjxU34IZ9BSZZsYIA
              JkZXwn5NshCHwv2tU9wyLvoWbDRyeF0Nqrw4lsprSbYrHaNZEJ1Mor8k93kdW/5B
              ewtzzzlIyCidqbB1SBYaj9QvRgO+UeNoEvqV2O4tOUr2FVwI/HHg3Pc0EHWfH2pY
              e5r5qCSVAgMBAAECggEAAbVoW2YJlL8+oUiRVX1WyMDRF/tSXULwxP1yyIWvRpfO
              J4OvLx77fssy0rRQgp9Rxql/Ac4tsV6yXQnPB6eJmXTY7nTmI2lrqzens/oQqFgI
              ry6uemt/Z853hqGsPKWaM1ByBe/fSTW25KkEYLf+ZzD1F61BkaK89dh3ixrlJmZD
              /eguWv0IupYHjoAZ3hT1yzs/Y9gqCmUY4/IrlTrlyVVbQbLwx6WfpuqUbNQsgAxC
              s8L7FSB63DAgLGrIjpnod/RwD0+ZKp8d0dkOM2BPYMj6MuDFWj3tw+DIHOqjUoqv
              hDkkkr1qVVY8UzmQJabVWvAPUE7F2P56ZBXPA7aWoQKBgQD9y1zPUJp7KhJ1PWkd
              XH38RrqxFhwbhbr0bUonXpHVGJjy2d8nPvYAJu1f6n6FCUmBApexNsukhUAf/iPm
              uVGAw11zG2xdFSVwI9gWyZEzYaV63+k3aKN3bpV3tbNw1rp7Gi+cj7Kli1i8iB8A
              6+JQcrYTw0+O+ZxlnohbHpXUtQKBgQDkbnasG03lMSlgpDED0PiWhbJor6Rfdw0h
              SjKyW1Qw5mceDq2BVHACoZyCYn96c09r0DeRfNVhRuESZAZ9dwe5Z/GoP+8w/1IU
              sGd73YwyyQ1sTfS36QOoLvVa3+Eur5knAZtJOj41msJ2aZUgJb9IlQHertrkXQuq
              s2ANDRvcYQKBgQC/WIsB1zCReZfvArz0oR5vjNgG2beZXIsm7BtDcX6b3m66cl9X
              1JVeafsAHOkE3oqnlM/PkZOZ18kQFej1dHUpkqIrPdrGl0HhuXSbQZ+S0KUV7imE
              WAUe76YLWlgO1CZG1+hbrs+vFk9x3WMaq722j7YNUmzyS+mJiCwgHwAyHQKBgHAr
              5k6BYfDoAT+ZoRAUr92KbZ+GkJroZSQxwU9gFamlmoFiB8V4Z0CDh81m/N5ufVOd
              /YuN12JbYe6b+6vkpYBgEITkUFqpJe9O6KIkmtHddJ/4b/FXlRojZQxo37UDOZuz
              6EM/PIkqI8/t7PLKVnIX6cEl8AsvvajnSIVgKIxBAoGBAK9t3/WcxpMOH0vmvyuV
              UajaSPkg5aOkLcMhVJntBb6xs7d67Cxy3WWIchp2z4GC4bKqCr4YVEVUerCqEMBO
              p7UMGkPgXYZW2D+OsfoNjwC9fpTMU0AJ1FVOM3BC3ZzTVVE0bb0CvvOgyUoUtBxB
              cF5Fom6maKg5evkrgMOZRJo0
              -----END PRIVATE KEY-----
              ',
                'client_email' => 'bucket-storage@bold-crossbar-358907.iam.gserviceaccount.com',
                'client_id' => '100026742826538967212',
                'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
                'token_uri' => 'https://oauth2.googleapis.com/token',
                'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
                'client_x509_cert_url' => 'https://www.googleapis.com/robot/v1/metadata/x509/bucket-storage%40bold-crossbar-358907.iam.gserviceaccount.com',
              ], // optional: Array of data that substitutes the .json file (see below)
            'project_id' => env('GOOGLE_CLOUD_PROJECT_ID', 'your-project-id'), // optional: is included in key file
            'bucket' => env('GOOGLE_CLOUD_STORAGE_BUCKET', 'your-bucket'),
            'path_prefix' => env('GOOGLE_CLOUD_STORAGE_PATH_PREFIX', ''), // optional: /default/path/to/apply/in/bucket
            'apiEndpoint' => env('GOOGLE_CLOUD_STORAGE_API_URI', null), // see: Public URLs below
            'visibility' => 'public', // optional: public|private
            'metadata' => ['cacheControl'=> 'public,max-age=86400'], // optional: default metadata
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
