<?php

namespace Harrison\LaravelFeatureManager\Exceptions;

use Harrison\LaravelFeatureManager\Constants\Exceptions\Common\DataDuplicate;
use Throwable;

class DataDuplicateException extends ApiException
{
    public function __construct(
        private ?Throwable $throwable = null
    ) {
        parent::__construct(
            DataDuplicate::getCode(),
            DataDuplicate::getMessage(),
            [],
            $throwable
        );
    }
}
