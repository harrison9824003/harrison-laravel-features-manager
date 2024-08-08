<?php

namespace Harrison\LaravelFeatureManager\Services\DataTypeFolder;

use Harrison\LaravelFeatureManager\Models\DataTypeFolder;
use Illuminate\Support\Collection;

class Admin
{
    public function getList(): Collection {
        return DataTypeFolder::paginate(
            $prePage = 15,
            $columns = ['*']
        );
    }

    public function getById(int $id): DataTypeFolder {
        return DataTypeFolder::findOrFail($id);
    }

    /**
     * 建立一筆新的資料類別
     */
    public function create(DataTypeFolder $dataTypeFolder): DataTypeFolder {
        if (DataTypeFolder::where('name', $dataTypeFolder->name)->exists()) {
            throw new \Exception('資料類別已存在');
        }
        return $dataTypeFolder->create([
            'name' => $dataTypeFolder->name,
            'models' => $dataTypeFolder->models
        ]);
    }
}
