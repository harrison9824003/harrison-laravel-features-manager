<?php

namespace Harrison\LaravelFeatureManager\Console\Commands;

use Harrison\LaravelFeatureManager\Models\DataType;
use Harrison\LaravelFeatureManager\Models\DataTypeFolder;
use Harrison\LaravelFeatureManager\Models\ValueObjects\Features\FeatureAbstract;
use Harrison\LaravelFeatureManager\Services\DataType\Admin as DataTypeAdmin;
use Harrison\LaravelFeatureManager\Services\DataTypeFolder\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InitFeaturesCommand extends Command
{
    protected $signature = 'harrison:init-features';

    protected $description = 'Init features';

    public function handle()
    {
        // 顯示訊息
        $this->info('Init features');

        try {
            // todo 資料庫設定
            DB::connection('mysql')->beginTransaction();
            // 取得設定檔
            $config = config('harrisonFeatureManger');

            // 建立未分類 data type folder
            $dataTypeFolder = app(DataTypeFolder::class);
            $dataTypeFolder->name = '未分類';
            $dataTypeFolder->models = '';
            /**
             * @var Admin $dataTypeFolderAdminService
             */
            $dataTypeFolderAdminService = app(Admin::class);
            $defaultFolder = $dataTypeFolderAdminService->create($dataTypeFolder);

            /**
             * @var DataTypeAdmin $dataTypteService
             */
            $dataTypteService = app(DataTypeAdmin::class);

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
                $parent = $dataTypteService->create($dataType);

                // 建立子功能
                $this->handelSubFeature($parent, $defaultFolder, $instance->getSubFeatures());
            }
            DB::connection('mysql')->commit();
        } catch (\Exception $e) {
            // 顯示錯誤訊息
            $this->error($e->getMessage());
            // 回滾
            DB::connection('mysql')->rollBack();
        }
    }

    /**
     * @param FeatureAbstract[] $subFeature
     */
    private function handelSubFeature(DataType $parent, DataTypeFolder $defaultFolder, array $subFeature): void {
        /**
         * @var DataTypeAdmin $dataTypteService
         */
        $dataTypteService = app(DataTypeAdmin::class);
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
            $dataTypteService->create($dataType);
        }
    }
}
