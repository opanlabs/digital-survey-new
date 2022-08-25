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
            'root' => storage_path('app'),
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
                'private_key_id' => 'bc90b8cb759ef88c0bf37b4f84113e95331da7b1',
                'private_key' => '-----BEGIN PRIVATE KEY-----
              MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCQzu+W9uNTIctR
              JDDHfj5sbGKfmR2ICmSZYyxsL/trorNeTKwf/LRi+uWMvWLkWJKFaY+a3Gj6JMcb
              OuquTRNDtf3uYTGwX9JamiyWb5iH7K/2zj+S7mRs2y3YmfLgnwkuwCTypE10H3yK
              tRsXgvjz1CSn/v83RTP3iBSem3UufGJVcPncFKRChegrDL9z4SdTsBYfbnw4a/qI
              WsdRdbtYATJEd8qXOaxmjKu86lomlmMXpLIZiZyw/7WHoPK3MjDgmGSAL7WxQU3D
              1R3oT0pQu1e13TJ6ws/PJtPBECBNkOoB59RHSpkBX9hnWPuYY24FifKPCyY3Q/zC
              Lmb3LqKJAgMBAAECgf9DB4bf2mhfksUKSjZKIaXDimgceEOzNRxb5AwsCAnZSPa+
              L799Dvxw1LJs8z1TdaxdFP/kLyJop52CfUMka4j/Tr68GUFm4vP7/GGnQQDZ6jWJ
              iO7klHTn7ozKNni2gOc/PLHdnzA7EFgV3L8tovKZ6xkMqnx4mQ/1BIiG4m7blQWr
              b2qlqsldHzdKFKBSTEm5Wr4yk5Y7IwGX/C/aZHaaUkix4xFwEfK/WHJkD9b60leu
              BstnzBdg+AEUCtvnUEYthem7gbu1uFamD+e4FMqWDQ9ylxduV99QvXG4Vc0JL91p
              D4MsSIQaYtOkWRq7x1hi2bPwt+EZmUZhouyewcMCgYEAw0b+cMyOphSd2v5dztPI
              cN/T9+HOVkZZeAY48oy1tBgMuJTzHJNuDeI3BU3s14GGec6rkKEf/e/Bp0cSlZc3
              3cr5j8U3APPeC60tngJevuE43tq/AbbA4SahdzrZpXGz82LAXfkO0IxppSSxUjTU
              +aD0TGjuwtioaW+iodEnuf8CgYEAvdZe5/AEhA2y83Esa/nqB2rpJsUJY+5ZSdd7
              9YXtysVH5JZOGmkIWtxGG6lM8c/rkcnL0a9Niu56zEKdnyHD7qW4jwwoTrxojfvd
              ZElYN+arM7pjPJoFmPtzhJOmxatIHUwkY3ApAwgThDZlPTIfBvCVdOnKr1+8QDFA
              k/yW03cCgYEAgOTJabb7qVAOadBgJvbPZQG4rfOT+Ipy37Brwl1ySi9dpjBaz8/Y
              Yr2gR5YJ8K2ED76Eq/BOZ5Tro/hbofWwYGtrkqRADBbrx5VFePhjhWav3RlR3lW8
              tmCDT2m+419Lwii6hMyyJKGp0eGIUZShxyugVRcmEeJkN0QCewDNUg0CgYEAtlFU
              kpJb8+soK09M52J8VaVix/5CF3xIunc+ML3wc2Zmtm14Ezs+b+zPVC+Tm0Uhq8FP
              g1FGOqDwxI1RzgvinacBCjkV2RBvpbT3miIqnH1nfOWL+x69M4CDIBeh+oOWXbTL
              2chVSvkNrVOEhXJGhCa4kzEZnLZoGIp0x+u1et8CgYAntZ0u1k2nyyrJDblKHbxm
              fizr+WM+I1evHS0iyD8iGIG4n9JZHrNCyDil8skQpUOnrAZ9ihDEZFsnuhzjeGDr
              2eaPzTEkgaG0eEsokZ4ocgHcSo78MlEHIfXIFqTsdpfIX3TIKJyZW55HL+4JimD3
              2hRhffpB2DKCtLa78PqoXg==
              -----END PRIVATE KEY-----
              ',
                'client_email' => 'allaccess@bold-crossbar-358907.iam.gserviceaccount.com',
                'client_id' => '118393914458967159932',
                'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
                'token_uri' => 'https://oauth2.googleapis.com/token',
                'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
                'client_x509_cert_url' => 'https://www.googleapis.com/robot/v1/metadata/x509/allaccess%40bold-crossbar-358907.iam.gserviceaccount.com',
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
