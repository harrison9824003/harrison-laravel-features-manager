<?php

namespace Harrison\LaravelFeatureManager\Models\ValueObjects\Features;

use Harrison\LaravelFeatureManager\Models\DataTypeFolder;
use Harrison\LaravelFeatureManager\Models\Enums\Permissions;

class DataTypeFolderFeature extends FeatureAbstract {
    public static function create(): FeatureAbstract {
        $dataTypeFolderFeature = new self();
        $dataTypeFolderFeature->setName('資料類別資料夾');
        $dataTypeFolderFeature->setFeature('dataTypeFolder');
        $dataTypeFolderFeature->setModel(DataTypeFolder::class);
        $dataTypeFolderFeature->setRootPath('');
        $dataTypeFolderFeature->setId(1);
        $dataTypeFolderFeature->setSubFeatures([
            DataTypeFeature::class
        ]);
        $dataTypeFolderFeature->setPermissions([
            Permissions::ADD,
            Permissions::DELETE,
            Permissions::EDIT,
            Permissions::LIST,
        ]);
        return $dataTypeFolderFeature;
    }
}