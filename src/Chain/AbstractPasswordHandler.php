<?php

namespace tastebay\Report\Handler;

/**
 * Class AbstractPasswordHandler
 */
abstract class AbstractPasswordHandler implements HandlerInterface
{
    /**
     * @var HandlerInterface
     */
    protected $next;

    /**
     * {@inheritdoc}
     */
    public function append(HandlerInterface $handler)
    {
        if ($this->next) {
            $this->next->append($handler);
        } else {
            $this->next = $handler;
        }

        return $this;
    }

    /**
     * @param string $password
     * @return bool
     */
    abstract protected function shouldHandle(string $password):bool;

    /**
     * @param string $password
     * @return string
     */
    public function handle(string $password):string
    {
        if ($this->next) {
            return $this->next->handle($password);
        }

        return $password;
    }
}
