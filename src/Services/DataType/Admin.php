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
}
