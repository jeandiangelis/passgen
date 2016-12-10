<?php

namespace Generator;

use Exception\EmptyWordsException;

/**
 * Class HumanReadableGenerator
 */
final class HumanReadableGenerator implements PasswordGenerator
{
    /**
     * @var \SplQueue
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

        shuffle($words);

        $this->words = new \SplQueue();

        foreach ($words as $word) {
            $this->words->enqueue($word);
        }

        $this->strength = $strength;
        $this->complexity = $complexity;
    }

    /**
     * @return string
     */
    public function generate():string
    {
        $password = '';
        $wordQuantity = $this->calculatePasswordStrength();

        for ($index = 0; $index < $wordQuantity; $index++) {
            $password .= $this->words->pop();
        }

        return $password;
    }

    /**
     * @return int
     */
    private function calculatePasswordStrength():int
    {
        $size = round(($this->strength / 10) * count($this->words));

        if ($size < 1) {
            $size = 1;
        }

        return $size;
    }
}
