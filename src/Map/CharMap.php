<?php

namespace Map;

use Exception\InvalidCharacterException;

/**
 * Class CharMap
 */
abstract class CharMap
{
    const DIGITS = [1, 2, 3, 4 ,5 ,6 ,7 ,8 ,9 ,0];

    const CHAR_MAP = [
        'a' => ['@', 'a', 'A'],
        'b' => ['|3', 'b', 'B'],
        'c' => ['(', 'c', 'C'],
        'd' => ['|)', 'd', 'D'],
        'e' => ['3', 'e', 'E'],
        'f' => ['f', 'F'],
        'g' => ['9', 'g', 'G'],
        'h' => ['#', 'h', 'H'],
        'i' => ['!', 'i', 'I'],
        'j' => ['_|', 'j', 'J'],
        'k' => ['|<', 'k', 'K'],
        'l' => ['|', 'l', 'L'],
        'm' => ['|||', 'm', 'M'],
        'n' => ['||', 'n', 'N'],
        'o' => ['0', 'o', 'O'],
        'p' => ['|>', 'p', 'P'],
        'q' => ['<|', 'q', 'Q'],
        'r' => ['|~', 'r', 'R'],
        's' => ['$', 's', 'S'],
        't' => ['7', 't' ,'T'],
        'u' => ['|_|', 'u', 'U'],
        'v' => ['|/', 'v', 'V'],
        'w' => ['w', 'W'],
        'x' => ['><', 'x', 'X'],
        'y' => ['y', 'Y'],
        'z' => ['z', 'Z']
    ];

    /**
     * @param string $char
     * @return string
     * @throws InvalidCharacterException
     */
    public static function transformLetter(string $char):string
    {
        $char = strtolower($char);

        if (!ctype_alpha($char)) {
            throw new InvalidCharacterException();
        }

        $charMap = self::CHAR_MAP[$char];
        $transformedChar = $charMap[array_rand($charMap)];

        return $transformedChar;
    }

    /**
     * @return string
     */
    public static function getRandomChar():string
    {
        $chars = str_split('~!@#$%^&*_-+=`|(){}[]:;"\'<>,.?/');

        return $chars[array_rand($chars)];
    }

    /**
     * @return int
     */
    public static function getRandomDigit():int
    {
        return self::DIGITS[array_rand(self::DIGITS)];
    }

    /**
     * @param string $char
     * @return string
     */
    public static function transformToDigit(string $char):string
    {
        $char = self::CHAR_MAP[strtolower($char)];

        if (is_numeric($char[0])) {
            return $char[0];
        }

        return '';
    }

    /**
     * @param bool $uppercase
     * @return string
     */
    public static function getRandomLetter(bool $uppercase = false):string
    {
        $letters = array_keys(self::CHAR_MAP);

        $letter = !$uppercase
            ? $letters[array_rand($letters)]
            : strtoupper($letters[array_rand($letters)])
        ;

        return $letter;
    }
}
