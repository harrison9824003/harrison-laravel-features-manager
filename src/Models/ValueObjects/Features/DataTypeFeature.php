<?php

namespace Harrison\LaravelFeatureManager\Models\ValueObjects\Features;

use Harrison\LaravelFeatureManager\Models\DataType;
use Harrison\LaravelFeatureManager\Models\Enums\Permissions;

class DataTypeFeature extends FeatureAbstract {
    public static function create(): FeatureAbstract {
        $dataTypeFeature = new self();
        $dataTypeFeature->setName('資料類別');
        $dataTypeFeature->setFeature('dataType');
        $dataTypeFeature->setModel(DataType::class);
        $dataTypeFeature->setRootPath('');
        $dataTypeFeature->setId(2);
        $dataTypeFeature->setPermissions([
            Permissions::ADD,
            Permissions::DELETE,
            Permissions::EDIT,
            Permissions::LIST,
        ]);
        return $dataTypeFeature;
    }
}
