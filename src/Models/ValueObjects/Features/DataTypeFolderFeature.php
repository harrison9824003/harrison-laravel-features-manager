<?php

namespace Harrison\LaravelFeatureManager\Models\ValueObjects\Features;

use Harrison\LaravelFeatureManager\Models\DataTypeFolder;

class DataTypeFolderFeature extends FeatureAbstract {
    public function __construct() {
        $this->setName('資料類別資料夾');
        $this->setModel(DataTypeFolder::class);
        $this->setRoot(route('dataFolder.index'));
        $this->setId(1);
        $this->setSubFeatures([
            DataTypeFeature::class
        ]);
    }
}