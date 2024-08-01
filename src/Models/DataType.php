<?php

namespace Harrison\LaravelFeatureManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Harrison\LaravelFeatureManager\Traits\HasModelId;
use Harrison\LaravelFeatureManager\Models\DataTypeFolder;

class DataType extends Model
{
    use HasFactory;
    use HasModelId;

    protected $table = 'pj_data_type';

    protected $fillable = [
        'id',
        'feature',
        'name',
        'model',
        'disabled',
        'icon',
        'folder_id',
        'router_path'
    ];

    public function folder()
    {
        return $this->hasOne(DataTypeFolder::class, 'id', 'folder_id');
    }
}
