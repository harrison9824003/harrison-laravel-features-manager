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
}
