<?php

namespace Harrison\LaravelFeatureManager\Services;

use Harrison\LaravelFeatureManager\Models\DataTypeFolder;
use Harrison\LaravelFeatureManager\Models\ValueObjects\Common\DataTypeFolderPageCondition;
use Harrison\LaravelFeatureManager\Models\ValueObjects\Common\PageCondition;
use Illuminate\Pagination\LengthAwarePaginator;

class DataTypeFolderService
{
    public function getByPage(PageCondition $condition): LengthAwarePaginator {
        return DataTypeFolder::with('dataType')
            ->paginate(
                perPage: $condition->getLimit(),
                columns: $condition->getColumns(),
                page: $condition->getPage(),
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
