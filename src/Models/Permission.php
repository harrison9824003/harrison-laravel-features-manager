<?php

namespace Harrison\LaravelFeatureManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $feature_id
 * @property string $permission
 * @property string $name
 * @property int $code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Permission extends Model
{
    use HasFactory;

    protected $table = 'pj_permission';

    protected $connection = 'harrisonFeatureManager';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $fillable = [
        'feature_id',
        'permission',
        'name',
        'code'
    ];
}
