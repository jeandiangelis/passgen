<?php

namespace tastebay\Report;

use Chain\Handler\NumericCharHandler;
use Chain\Handler\PasswordLengthHandler;
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
        $this->chain = (new PasswordLengthHandler())
            ->append(new NumericCharHandler())

        ;
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
