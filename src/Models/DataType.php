<?php

namespace Harrison\LaravelFeatureManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Harrison\LaravelFeatureManager\Traits\HasModelId;
use Harrison\LaravelFeatureManager\Models\DataTypeFolder;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $feature
 * @property string $name
 * @property string $model
 * @property int $disabled
 * @property string $icon
 * @property int $folder_id
 * @property int $parent_id
 * @property string $router_path
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class DataType extends Model
{
    use HasFactory;
    use HasModelId;

    protected $table = 'pj_data_type';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $fillable = [
        'id',
        'feature',
        'name',
        'model',
        'disabled',
        'icon',
        'folder_id',
        'parent_id',
        'router_path'
    ];

    public function folder()
    {
        return $this->hasOne(DataTypeFolder::class, 'id', 'folder_id');
    }
}
