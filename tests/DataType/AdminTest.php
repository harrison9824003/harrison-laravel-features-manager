<?php

namespace Harrison\LaravelFeatureManager\Tests\DataType;

use Harrison\LaravelFeatureManager\Models\DataType;
use Harrison\LaravelFeatureManager\Services\DataType\Admin;
use Harrison\LaravelFeatureManager\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{
    use DatabaseTransactions;

    protected Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = new Admin();
    }

    public function testGetList()
    {
        DataType::create([
            'name' => 'test',
            'model' => 'test',
            'feature' => 'test',
            'disabled' => 0,
            'icon' => 'test',
            'folder_id' => 1,
            'router_path' => 'test',
        ]);


        // 调用 getList 方法
        $result = $this->admin->getList(1);

        // 断言返回结果是一个 LengthAwarePaginator 实例
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $result);

        // 断言分页结果的数量
        $this->assertCount(1, $result->items());
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
            'folder_id' => 1,
            'router_path' => 'test',
        ]);

        // 调用 getById 方法
        $result = $this->admin->getById($dataType->id);

        // 断言返回结果是一个 DataType 实例
        $this->assertInstanceOf(DataType::class, $result);

        // 断言返回的实例与创建的实例相同
        $this->assertEquals($dataType->id, $result->id);
    }
}
