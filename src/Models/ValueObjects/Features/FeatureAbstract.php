<?php

namespace Harrison\LaravelFeatureManager\Models\ValueObjects\Features;

abstract class FeatureAbstract {
    /**
     * @var string $feature 功能名稱
     */
    private string $feature;

    /**
     * @var string $name 顯示名稱
     */
    private string $name;

    /**
     * @var string $model 使用的 model 來操作資料
     */
    private mixed $model;

    /**
     * @var string $root 功能路由 root
     */
    private string $routerPath;

    /**
     * @var int $id 功能 id
     */
    private int $id;

    /**
     * @var Feature[] $subFeatures 子功能
     */
    private array $subFeatures;

    /**
     * @var Permissions[] $permissions 權限
     */
    private array $permissions;

    public function setFeature(string $feature): void {
        $this->feature = $feature;
    }

    public function getFeature(): string {
        return $this->feature;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setModel(string $model): void {
        $this->model = $model;
    }

    public function getModel(): string {
        return $this->model;
    }

    public function setRootPath(string $routerPath): void {
        $this->routerPath = $routerPath;
    }

    public function getRootPath(): string {
        return $this->routerPath;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setSubFeatures(array $subFeatures): void {
        $this->subFeatures = $subFeatures;
    }

    public function getSubFeatures(): array {
        return $this->subFeatures;
    }

    public function setPermissions(array $permissions): void {
        $this->permissions = $permissions;
    }

    public function getPermissions(): array {
        return $this->permissions;
    }

    abstract public static function create(): FeatureAbstract;
}
