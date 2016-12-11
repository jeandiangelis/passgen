<?php

namespace tastebay\Report\Handler;

/**
 * Interface HandlerInterface
 */
interface HandlerInterface
{
    /**
     * Set the handler that will be executed
     * next
     *
     * @param HandlerInterface $handler
     * @return HandlerInterface
     */
    public function append(HandlerInterface $handler);
}
