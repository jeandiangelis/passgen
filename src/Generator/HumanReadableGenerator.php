<?php

namespace Generator;

use Chain\PasswordChainBuilder;
use Exception\EmptyWordsException;
use Map\CharMap;

/**
 * Class HumanReadableGenerator
 */
final class HumanReadableGenerator implements PasswordGeneratorInterface
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

        if ($strength <= 0
            || $strength > 10
            || $complexity <= 0
            || $complexity > 10
        ) {
            throw new \OutOfRangeException('Complexity and strength must be greater than 0 and smaller than 11.');
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
        $password = $this->buildPasswordString();
        $tempPassword = [];

        foreach (str_split($password) as $key => $character) {
            $value = (rand(0, 100) / 100);

            if ($value <= $this->calculateProbabilityToChange()
                && ctype_alpha($password[$key])
            ) {
                $transformedChar = CharMap::transformLetter($password[$key]);
                $tempPassword[] = $transformedChar;

                continue;
            }

            $tempPassword[] = $password[$key];
        }

        return (new PasswordChainBuilder())->doChain(implode($tempPassword));
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

    /**
     * @return float
     */
    private function calculateProbabilityToChange():float
    {
        return ($this->complexity / 10);
    }

    /**
     * @return string
     */
    private function buildPasswordString():string
    {
        $password = '';
        $wordQuantity = $this->calculatePasswordStrength();

        for ($index = 0; $index < $wordQuantity; $index++) {
            $password .= $this->words->pop();

            $value = (rand(0, 100) / 100);
            if ($value <= ($this->calculateProbabilityToChange() / 5)) {
                $password .= CharMap::getRandomChar();
            }
        }

        return $password;
    }
}
