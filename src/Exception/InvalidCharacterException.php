<?php

namespace Exception;

/**
 * Class InvalidCharacterException
 */
final class InvalidCharacterException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, \Exception $previous = null)
    {
        $message = $message ?? 'Only letters are allowed [a-z][A-Z]';

        parent::__construct($message, $code, $previous);
    }
}
