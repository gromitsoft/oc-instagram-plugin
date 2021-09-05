<?php

namespace GromIT\Instagram\Traits;

trait SelfMakeable
{
    /**
     * @return static
     * @noinspection PhpMissingReturnTypeInspection
     */
    public static function make()
    {
        return app(static::class);
    }
}
