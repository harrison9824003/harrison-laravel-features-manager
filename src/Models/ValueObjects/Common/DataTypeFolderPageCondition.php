<?php

namespace Harrison\LaravelFeatureManager\Models\ValueObjects\Common;

/**
 * @inheritDoc
 */
class DataTypeFolderPageCondition extends PageCondition
{
    public function __construct(
        private int $page,
        private int $limit,
        private array $columns = ['*']
    ) {
        parent::__construct($page, $limit, $columns);
    }
}
