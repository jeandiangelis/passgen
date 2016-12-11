<?php

namespace tastebay\Report;

use tastebay\Report\Handler\HandlerInterface;

/**
 * Class PasswordChainBuilder
 */
final class PasswordChainBuilder
{
    /**
     * @var HandlerInterface
     */
    private $chain;

    /**
     * Creates the Chain of Responsibility
     */
    public function __construct()
    {
        $this->chain = '';
    }

    /**
     * @param $password
     * @return string
     */
    public function doChain($password)
    {
        return $this->chain->handle($password);
    }
}
