<?php

namespace Harrison\LaravelFeatureManager\Models\ValueObjects\Common;

/**
 * @inheritDoc
 * @property int id 資料類別ID
 */
class DataTypePageCondition extends PageCondition
{
    public function __construct(
        private int $page,
        private int $limit,
        private ?int $id,
        private array $columns = ['*']
    ) {
        parent::__construct($page, $limit, $columns);
    }

    public function getId(): int {
        return $this->id;
    }
}
