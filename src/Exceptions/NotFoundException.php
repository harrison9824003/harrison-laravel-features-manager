<?php

namespace Harrison\LaravelFeatureManager\Exceptions;

use Harrison\LaravelFeatureManager\Constants\Exceptions\Common\NotFound;
use Throwable;

class NotFoundException extends ApiException
{
    public function __construct(
        private ?Throwable $throwable = null
    ) {
        parent::__construct(
            NotFound::getCode(),
            NotFound::getMessage(),
            [],
            $throwable
        );
    }
}
