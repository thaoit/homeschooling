<?php

return [

    'role' => [
        'admin'   => 'Admin',
        'parent'  => 'Parent',
        'child'   => 'Child'
    ],

    'gender' => [
        'all'     => 'All',
        'male'    => 'Male',
        'female'  => 'Female',
        'others'  => 'Others'
    ],

    'media_type' => [
        'image'     => 'Image',
        'audio_video'     => 'Audio / Video',
        'document'  => 'Document',
        'others' => 'Others'
    ],

    'lesson_status' => [
        'draft'     => 'Draft',
        'publish'   => 'Publish'
    ],

    'countries' => [
        'all'       =>  [
                          'name' => 'All',
                          'provinces' => [
                            'all' => 'All'
                          ]
                        ],
        'vietnam'   =>  [
                          'name' => 'Vietnam',
                          'provinces' => [
                              'hanoi' => 'Hanoi',
                              'danang' => 'Danang',
                              'hochiminh' => 'Ho Chi Minh city'
                          ]
                        ],
        'us'         => [
                          'name' => 'US',
                          'provinces' => [
                              'washington' => 'WaShington D.C',
                              'california' => 'California'
                          ]
                        ],
         'japan'      => [
                            'name' => 'Japan'
                          ]
    ],

    'messages' => [
        'authentication' => 'You need to login to do action',
        'like_ownself' => "You're only allowed to Like lesson from others",
        'unlike_ownself' => "You're only allowed to Like lesson from others"
    ]
];

 ?>
