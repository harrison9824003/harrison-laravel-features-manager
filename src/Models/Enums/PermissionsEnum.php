<?php

namespace Harrison\LaravelFeatureManager\Models\Enums;

enum PermissionsEnum: int {
    case ADD = 1;
    case DELETE = 2;
    case EDIT = 4;
    case LIST = 8;
    case ADMIN = 16;
    case VIEW = 32;

    public function getPermissionName(): string {
        return match ($this) {
            self::ADD => PermissionsNameEnum::ADD->value,
            self::DELETE => PermissionsNameEnum::DELETE->value,
            self::EDIT => PermissionsNameEnum::EDIT->value,
            self::LIST => PermissionsNameEnum::LIST->value,
            self::ADMIN => PermissionsNameEnum::ADMIN->value,
            self::VIEW => PermissionsNameEnum::VIEW->value,
            default => PermissionsNameEnum::NONE->value,
        };
    }

    public function getPermissionChineseName(): string {
        return match ($this) {
            self::ADD => PermissionsChineseNameEnum::ADD->value,
            self::DELETE => PermissionsChineseNameEnum::DELETE->value,
            self::EDIT => PermissionsChineseNameEnum::EDIT->value,
            self::LIST => PermissionsChineseNameEnum::LIST->value,
            self::ADMIN => PermissionsChineseNameEnum::ADMIN->value,
            self::VIEW => PermissionsChineseNameEnum::VIEW->value,
            default => PermissionsChineseNameEnum::NONE->value,
        };
    }
}
