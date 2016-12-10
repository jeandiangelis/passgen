<?php

namespace Generator;

use Exception\EmptyWordsException;

/**
 * Class HumanReadableGenerator
 */
final class HumanReadableGenerator implements PasswordGenerator
{
    /**
     * @var array
     */
    private $words;

    /**
     * @var int
     */
    private $strength;

    /**
     * @var int
     */
    private $complexity;

    /**
     * HumanReadableGenerator constructor.
     * @param array $words
     * @param int $strength
     * @param int $complexity
     * @throws EmptyWordsException
     */
    public function __construct(array $words, int $strength, int $complexity)
    {
        if (empty($words)) {
            throw new EmptyWordsException();
        }

        $this->words = $words;
        $this->strength = $strength;
        $this->complexity = $complexity;
    }

    /**
     * @return string
     */
    public function generate():string
    {
        return 'a';
    }
}
