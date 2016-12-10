<?php

namespace Map;

use Exception\InvalidCharacterException;

/**
 * Class CharMap
 */
abstract class CharMap
{
    const MAP = [
        'a' => ['4', '@'],
        'b' => ['|3'],
        'c' => ['(', '<', '['],
        'd' => ['|)', 'o|'],
        'e' => ['3', '&'],
        'f' => ['f'],
        'g' => ['9'],
        'h' => ['#'],
        'i' => ['!'],
        'j' => ['_|'],
        'k' => ['|<'],
        'l' => ['|'],
        'm' => ['|||'],
        'n' => ['||'],
        'o' => ['0', '[]'],
        'p' => ['|>'],
        'q' => ['<|'],
        'r' => ['|~'],
        's' => ['$'],
        't' => ['7'],
        'u' => ['|_|'],
        'v' => ['|/'],
        'w' => ['w'],
        'x' => ['><'],
        'y' => ['y'],
        'z' => ['z']
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
