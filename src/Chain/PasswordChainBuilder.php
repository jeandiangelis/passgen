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
     * @param $order
     * @param Collection $reportTypes
     * @return bool
     */
    public function doChain($order, Collection $reportTypes)
    {
        return $this->chain->sendOrderReport($order, $reportTypes);
    }
}
