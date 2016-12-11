<?php

namespace Chain;

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

    /**
     * @param string $password
     * @return string
     */
    public function handle(string $password):string ;
}
