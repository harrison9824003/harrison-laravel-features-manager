<?php

namespace Harrison\LaravelFeatureManager\Console\Commands;

use Exception;
use Harrison\LaravelFeatureManager\Models\DataType;
use Harrison\LaravelFeatureManager\Models\DataTypeFolder;
use Harrison\LaravelFeatureManager\Models\Enums\PermissionsEnum;
use Harrison\LaravelFeatureManager\Models\Permission;
use Harrison\LaravelFeatureManager\Models\ValueObjects\Features\FeatureAbstract;
use Harrison\LaravelFeatureManager\Services\DataType\Admin as DataTypeAdmin;
use Harrison\LaravelFeatureManager\Services\DataTypeFolder\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RefreshFeaturesCommand extends Command
{
    protected $signature = 'harrison:refresh-features';

    protected $description = 'Refresh features';

    public function __construct(
        private DataTypeAdmin $dataTypteService,
        private Admin $dataTypeFolderAdminService,
    ) {
        parent::__construct();
    }

    public function handle()
    {
        // 顯示訊息
        $this->info('Refresh features');

        $this->deleteDataTypeAndDataTypeFolder();

        try {
            // todo 資料庫設定
            DB::connection('harrison_laravel_feature_manager')->beginTransaction();
            // 取得設定檔
            $config = config('harrison_feature_manger');

            // 建立未分類 data type folder
            $dataTypeFolder = app(DataTypeFolder::class);
            $dataTypeFolder->name = '未分類';
            $dataTypeFolder->models = '';

            $defaultFolder = $this->dataTypeFolderAdminService->create($dataTypeFolder);

            // 建立 features array 中的 class
            /**
             * @var FeatureAbstract $feature
             */
            foreach ($config['features'] as $feature) {
                $instance = $feature::create();
                if (!is_subclass_of($instance, FeatureAbstract::class)) {
                    throw new \Exception('Error feature: ' . $feature);
                }
                $this->info('Create feature: ' . $feature);

                // insert into database
                $dataType = app(DataType::class);
                $dataType->feature = $instance->getFeature();
                $dataType->name = $instance->getName();
                $dataType->model = $instance->getModel();
                $dataType->disabled = 0;
                $dataType->icon = '';
                $dataType->folder_id = $defaultFolder->id;
                $dataType->parent_id = 0;
                $dataType->router_path = $instance->getRootPath();
                $parent = $this->dataTypteService->create($dataType);

                // 建立子功能
                $this->handleSubFeature($parent, $defaultFolder, $instance->getSubFeatures());

                // 建立權限
                $this->handlePermissions($parent, $instance->getPermissions());
            }
            DB::connection('harrison_laravel_feature_manager')->commit();
        } catch (\Exception $e) {
            // 顯示錯誤訊息
            $this->error($e->getMessage());
            // 回滾
            DB::connection('harrison_laravel_feature_manager')->rollBack();
        }
    }

    /**
     * @param FeatureAbstract[] $subFeature
     */
    private function handleSubFeature(DataType $parent, DataTypeFolder $defaultFolder, array $subFeature): void
    {
        foreach ($subFeature as $feature) {
            $instance = $feature::create();
            if (!is_subclass_of($instance, FeatureAbstract::class)) {
                throw new \Exception('Error feature: ' . $feature);
            }
            $this->info('Create feature: ' . $feature);

            // insert into database
            $dataType = app(DataType::class);
            $dataType->feature = $instance->getFeature();
            $dataType->name = $instance->getName();
            $dataType->model = $instance->getModel();
            $dataType->disabled = 0;
            $dataType->icon = '';
            $dataType->folder_id = $defaultFolder->id;
            $dataType->parent_id = $parent->id;
            $dataType->router_path = $instance->getRootPath();
            $dataType = $this->dataTypteService->create($dataType);

            // 建立權限
            $this->handlePermissions($dataType, $instance->getPermissions());
        }
    }

    /**
     * @var PermissionsEnum[] $permissions
     */
    private function handlePermissions(DataType $dataType, array $permissionsEnum): void
    {
        /**
         * @var PermissionsEnum $permissionEnum
         */
        foreach ($permissionsEnum as $permissionEnum) {
            // insert into database
            /**
             * @var Permission $permission
             */
            $permission = app(Permission::class);
            $permission->feature_id = $dataType->id;
            $permission->permission = $permissionEnum->getPermissionName();
            $permission->name = $permissionEnum->getPermissionChineseName();
            $permission->code = $permissionEnum->value;
            $permission->save();
        }
    }

    private function deleteDataTypeAndDataTypeFolder(): void
    {
        try {
            DB::connection('harrison_laravel_feature_manager')->beginTransaction();

            DB::connection('harrison_laravel_feature_manager')->table('pj_data_type')->delete();
            DB::connection('harrison_laravel_feature_manager')->table('pj_datatype_folder')->delete();

            // commit
            DB::connection('harrison_laravel_feature_manager')->commit();
        } catch (Exception $e) {
            // 顯示錯誤訊息
            $this->error($e->getMessage());
            // 回滾
            DB::connection('harrison_laravel_feature_manager')->rollBack();
        }

        try {
            // auto increment reset
            DB::connection('harrison_laravel_feature_manager')->statement('ALTER TABLE pj_data_type AUTO_INCREMENT = 1');
            DB::connection('harrison_laravel_feature_manager')->statement('ALTER TABLE pj_datatype_folder AUTO_INCREMENT = 1');
        } catch (Exception $e) {
            // 顯示錯誤訊息
            $this->error($e->getMessage());
        }
    }
}
