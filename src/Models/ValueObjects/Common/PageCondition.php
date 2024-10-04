<?php

namespace Harrison\LaravelFeatureManager\Models\ValueObjects\Common;

/**
 * 商品列表分頁條件
 * @property int $page 當前頁碼
 * @property int $limit 每頁筆數
 * @property array $columns 欄位
 */
class PageCondition
{
    public function __construct(
        private int $page,
        private int $limit,
        private array $columns = ['*']
    ) {}

    public function getPage(): int {
        return $this->page;
    }

    public function getLimit(): int {
        return $this->limit;
    }

    public function getColumns(): array {
        return $this->columns;
    }

    public function setColumns(array $columns): void {
        $this->columns = $columns;
    }
}
