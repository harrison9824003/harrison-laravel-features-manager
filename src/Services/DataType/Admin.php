<?php

namespace Harrison\LaravelFeatureManager\Services\DataType;

use Harrison\LaravelFeatureManager\Models\DataType;
use Illuminate\Pagination\LengthAwarePaginator;

class Admin
{
    public function getList(int $dataTypeFolder): LengthAwarePaginator {
        return DataType::where('folder_id', $dataTypeFolder)->paginate(
            $prePage = 15,
            $columns = ['*']
        );
    }

    public function getById(int $id): DataType {
        return DataType::findOrFail($id);
    }

    /**
     * 建立一筆新的資料類別
     */
    public function create(DataType $dataType): DataType {
        if (DataType::where('feature', $dataType->feature)->exists()) {
            throw new \Exception('資料類別已存在');
        }
        return $dataType->create([
            'feature' => $dataType->feature,
            'name' => $dataType->name,
            'model' => $dataType->model,
            'disabled' => $dataType->disabled,
            'icon' => $dataType->icon,
            'folder_id' => $dataType->folder_id,
            'parent_id' => $dataType->parent_id,
            'router_path' => $dataType->router_path
        ]);
    }
}
