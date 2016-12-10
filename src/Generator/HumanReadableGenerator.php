<?php

namespace Generator;

use Exception\EmptyWordsException;
use Map\CharMap;
use Validator\PasswordValidator;

/**
 * Class HumanReadableGenerator
 */
final class HumanReadableGenerator implements PasswordGenerator
{
    const ADJUST = 0.05;

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

        $probabilityToChange = ($this->complexity / 10) - self::ADJUST;
        $tempPassword = '';

        foreach (str_split($password) as $key => $character) {
            $value = (rand(0, 100) / 100);

            if ($value <= $probabilityToChange) {
                $tempPassword .= CharMap::transformLetter($character);
                continue;
            }

            $tempPassword .= $character;
        }

        $password = $tempPassword . $this->getMissingChars($password);

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

    /**
     * @param string $password
     * @return string
     */
    private function getMissingChars(string $password):string
    {
        $missingChars = '';

        for ($i = 0; $i < (PasswordValidator::REQUIRED_PASSWORD_SIZE - strlen($password)); $i++) {
            $missingChars .= CharMap::getRandomChar();
        }

        return $missingChars;
    }
}
