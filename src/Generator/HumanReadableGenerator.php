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
        $unchangeableIndex = [];
        $wordQuantity = $this->calculatePasswordStrength();
        $probabilityToChange = ($this->complexity / 10);
        $tempPassword = [];
        $hasDigit = false;
        $hasSpecialCharacter = false;

        for ($index = 0; $index < $wordQuantity; $index++) {
            $password .= $this->words->pop();

            $value = (rand(0, 100) / 100);
            if ($value <= ($probabilityToChange / 3)) {
                $password .= CharMap::getRandomChar();
            }
        }

        $letterIndexes = array_keys(str_split($password));
        shuffle($letterIndexes);

        foreach ($letterIndexes as $key => $index) {
            if (ctype_alpha($password[$index])
                && count($unchangeableIndex) < 2
            ) {
                $unchangeableIndex[] = $index;
            }
        }

        foreach (str_split($password) as $key => $character) {
            $value = (rand(0, 100) / 100);

            if ($value <= $probabilityToChange
                && ctype_alpha($password[$key])
                && !in_array($key, $unchangeableIndex)
            ) {
                $transformedChar = CharMap::transformLetter($password[$key]);
                $tempPassword[] = $transformedChar;

                if (is_numeric($transformedChar) && !$hasDigit) {
                    $hasDigit = true;
                }

                if (!$hasSpecialCharacter
                    && !is_numeric($transformedChar)
                    && !ctype_alpha($transformedChar)
                ) {
                    $hasSpecialCharacter = true;
                }

                continue;
            }

            $tempPassword[] = $password[$key];
        }

        $password = implode($tempPassword) . $this->getMissingChars($password);
        $password[$unchangeableIndex[0]] = strtolower($password[$unchangeableIndex[0]]);

        if (!preg_match('/[A-Z]/', $password)
            && isset($unchangeableIndex[1])
        ) {
            $password[$unchangeableIndex[1]] = strtoupper($password[$unchangeableIndex[1]]);
        } elseif (!preg_match('/[A-Z]/', $password)) {
            $password .= chr(rand(65,90));
        }

        if (!$hasDigit) {
            $password .= CharMap::DIGITS[array_rand(CharMap::DIGITS)];
        }

        if (!$hasSpecialCharacter) {
            $password .= CharMap::getRandomChar();
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
