<?php

namespace Harrison\LaravelFeatureManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Harrison\LaravelFeatureManager\Traits\HasModelId;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $models
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class DataTypeFolder extends Model
{
    use HasFactory;
    use HasModelId;

    protected $table = 'pj_datatype_folder';

    protected $connection = 'harrisonFeatureManager';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $fillable = [
        'name',
        'models'
    ];
}
