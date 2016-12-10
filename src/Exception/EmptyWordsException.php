<?php

namespace Exception;

/**
 * Class EmptyWordsException
 */
final class EmptyWordsException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, \Exception $previous = null)
    {
        $message = $message ?? 'Words canont be empty';

        parent::__construct($message, $code, $previous);
    }
}
