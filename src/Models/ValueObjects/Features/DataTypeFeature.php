<?php

namespace Harrison\LaravelFeatureManager\Models\ValueObjects\Features;

use Harrison\LaravelFeatureManager\Models\DataType;
use Harrison\LaravelFeatureManager\Models\Enums\PermissionsEnum;

class DataTypeFeature extends FeatureAbstract {
    public static function create(): FeatureAbstract {
        $dataTypeFeature = new self();
        $dataTypeFeature->setName('資料類別');
        $dataTypeFeature->setFeature('dataType');
        $dataTypeFeature->setModel(DataType::class);
        $dataTypeFeature->setRootPath('');
        $dataTypeFeature->setId(2);
        $dataTypeFeature->setPermissions([
            PermissionsEnum::ADD,
            PermissionsEnum::DELETE,
            PermissionsEnum::EDIT,
            PermissionsEnum::LIST,
        ]);
        return $dataTypeFeature;
    }
}
