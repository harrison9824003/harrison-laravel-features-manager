<?php

namespace Harrison\LaravelFeatureManager\Tests\DataType;

use Harrison\LaravelFeatureManager\Models\DataType;
use Harrison\LaravelFeatureManager\Services\DataTypeService;
use Harrison\LaravelFeatureManager\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PDO;

class AdminTest extends TestCase
{
    // use DatabaseTransactions;
    // use RefreshDatabase;

    protected DataTypeService $dataTypeService;

    protected function setUp(): void
    {
        parent::setUp();
        // 設定資料庫連線
        config(['database.connections.harrison_laravel_feature_manager' => [
            'driver' => 'mysql',
            'url' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_URL'),
            'host' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_HOST', '127.0.0.1'),
            'port' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_PORT', '3306'),
            'database' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_DATABASE', 'laravel_package'),
            'username' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_USERNAME', 'root'),
            'password' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_PASSWORD', '123456'),
            'unix_socket' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_SOCKET', ''),
            'charset' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_CHARSET', 'utf8mb4'),
            'collation' => env('DB_HARRISON_LARAVEL_FEATURE_MANAGER_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ]]);

        $this->dataTypeService = new DataTypeService();
    }

    public function testGetList()
    {
        DataType::create([
            'name' => 'test',
            'model' => 'test',
            'feature' => 'test',
            'disabled' => 0,
            'icon' => 'test',
            'folder_id' => 2,
            'router_path' => 'test',
        ]);


        // 调用 getList 方法
        $result = $this->dataTypeService->getList(2);

        // 断言返回结果是一个 LengthAwarePaginator 实例
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $result);

        // 檢查資料庫內是否有 name = 'test'
        $this->assertDatabaseHas('pj_data_type', ['name' => 'test']);
    }

    public function testGetById()
    {
        // 创建一个测试数据
        $dataType = DataType::create([
            'name' => 'test',
            'model' => 'test',
            'feature' => 'test',
            'disabled' => 0,
            'icon' => 'test',
            'folder_id' => 2,
            'router_path' => 'test',
        ]);

        // 调用 getById 方法
        $result = $this->dataTypeService->getById($dataType->id);

        // 断言返回结果是一个 DataType 实例
        $this->assertInstanceOf(DataType::class, $result);

        // 断言返回的实例与创建的实例相同
        $this->assertEquals($dataType->id, $result->id);
    }
}
