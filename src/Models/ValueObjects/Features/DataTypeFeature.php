<?php

namespace Harrison\LaravelFeatureManager\Models\ValueObjects\Features;

use Harrison\LaravelFeatureManager\Models\DataType;

class DataTypeFeature extends FeatureAbstract {
    public function __construct() {
        $this->setName('資料類別');
        $this->setModel(DataType::class);
        $this->setRoot(route('dataType.index'));
        $this->setId(2);
    }
}
