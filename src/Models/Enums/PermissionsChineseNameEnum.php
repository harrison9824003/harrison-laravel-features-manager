<?php

namespace Harrison\LaravelFeatureManager\Models\Enums;

enum PermissionsChineseNameEnum: string {
    case ADD = '新增';
    case DELETE = '刪除';
    case EDIT = '編輯';
    case LIST = '列表';
    case ADMIN = '管理';
    case VIEW = '檢視';
    case NONE = '未知權限';
}
