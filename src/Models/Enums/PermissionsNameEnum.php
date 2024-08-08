<?php

namespace Harrison\LaravelFeatureManager\Models\Enums;

enum PermissionsNameEnum: string {
    case ADD = 'add';
    case DELETE = 'delete';
    case EDIT = 'edit';
    case LIST = 'list';
    case ADMIN = 'admin';
    case VIEW = 'view';
    case NONE = 'none';
}
