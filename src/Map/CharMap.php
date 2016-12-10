<?php

namespace Map;

use Exception\InvalidCharacterException;

/**
 * Class CharMap
 */
abstract class CharMap
{
    const MAP = [
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
        if (!ctype_alpha($char)) {
            throw new InvalidCharacterException();
        }

        $charMap = self::MAP[$char];

        $transformedChar = $charMap[array_rand($charMap)];

        if ($transformedChar === $char) {
            return $char;
        }

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
}
