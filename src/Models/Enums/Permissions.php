<?php

namespace Harrison\LaravelFeatureManager\Models\Enums;

enum Permissions: int {
    case ADD = 1;
    case DELETE = 2;
    case EDIT = 4;
    case LIST = 8;
    case ADMIN = 16;
    case VIEW = 32;

    public function getPermissionName(): string {
        return match ($this) {
            self::ADD => PermissionsName::ADD->value,
            self::DELETE => PermissionsName::DELETE->value,
            self::EDIT => PermissionsName::EDIT->value,
            self::LIST => PermissionsName::LIST->value,
            self::ADMIN => PermissionsName::ADMIN->value,
            self::VIEW => PermissionsName::VIEW->value,
            default => PermissionsName::NONE->value,
        };
    }
}