<?php

namespace Generator;

/**
 * Interface PasswordGenerator
 */
interface PasswordGeneratorInterface
{
    /**
     * @return string
     */
    public function generate():string;
}
