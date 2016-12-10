<?php

namespace Generator;

/**
 * Interface PasswordGenerator
 */
interface PasswordGenerator
{
    /**
     * @return string
     */
    public function generate():string;
}
