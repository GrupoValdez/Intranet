<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace"
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'visibility' => 'public',
        ],

        'ubUploads' => [
            'driver' => 'local',
            'root'   => 'public/assets/images/documents-admin/',
        ],
        #documen
        // 'ubUploadsChange' => [
        //     'driver' => 's3',
        //     'key' => 'TLCQ8T7MCYDE2CC7OMGY',
        //     'secret' => 'eKBAGapaeNvyEwsrGG-B3NGYp2oeWWX1_7CxSg==',
        //     'region' => 'eu-west-1',
        //     'bucket' => 'documents-admin',
        //     'endpoint' => 'https://cellar.services.clever-cloud.com',
        // ],
        // Fto

        'ubUploadsChange' => [
            'driver'   => 'ftp',
            'host'     => 'bucket-1237ad59-1025-48ba-90c5-d567e8ecd3dc-fsbucket.services.clever-cloud.com',
            'username' => 'user1237ad59102548ba90c5d567e8ecd3dc',
            'password' => 'i0s2xIqSp2zuGKxL',
        ],

        's3' => [
            'driver' => 's3',
            'key' => 'your-key',
            'secret' => 'your-secret',
            'region' => 'your-region',
            'bucket' => 'your-bucket',
        ],

    ],

];
