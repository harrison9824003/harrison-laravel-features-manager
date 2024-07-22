<?php

return [
    'features' => [
        'dataFolder' => [
            // 顯示名稱
            'name' => '資料類別資料夾',
            // 使用 model
            'model' => 'Harrison\LaravelProduct\Models\DataTypeFolder',
            // 功能路由 root
            'root' => route('dataFolder.index'),
            // 功能 id
            'id' => 1,
            // 子功能
            'features' => [
                'dataType' => [
                    'name' => '資料類別',
                    'model' => 'Harrison\LaravelProduct\Models\DataType',
                    'root' => route('dataType.index'),
                    'id' => 2
                ],
            ]
        ],
    ]
];
