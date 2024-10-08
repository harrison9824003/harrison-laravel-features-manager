<?php

namespace Harrison\LaravelFeatureManager\Services;

use Harrison\LaravelFeatureManager\Models\DataType;
use Harrison\LaravelFeatureManager\Models\ValueObjects\Common\DataTypePageCondition;
use Illuminate\Pagination\LengthAwarePaginator;

class DataTypeService
{
    public function getPage(DataTypePageCondition $condition): LengthAwarePaginator {
        return DataType::orderBy('id', 'desc')
            ->paginate(
                $page = $condition->getPage(),
                $prePage = $condition->getLimit(),
                $columns = $condition->getColumns()
            );
    }

    public function getListByFolderId(DataTypePageCondition $condition): LengthAwarePaginator {
        return DataType::orderBy('id', 'desc')
            ->when($condition->getId(), function ($query, $id) {
                return $query->where('folder_id', $id);
            })       
            ->paginate(
                $page = $condition->getPage(),
                $prePage = $condition->getLimit(),
                $columns = $condition->getColumns()
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
