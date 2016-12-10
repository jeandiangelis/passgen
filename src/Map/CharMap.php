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
        'c' => ['(', '<'],
        'd' => ['|)', 'o|'],
        'e' => ['3', '&']
    ];

    /**
     * @param string $char
     * @return string
     * @throws InvalidCharacterException
     */
    public static function transformLetter(string $char):string
    {
        if (!array_key_exists(strtolower($char), self::MAP)) {
            throw new InvalidCharacterException();
        }

        $charMap = self::MAP[$char];

        return $charMap[array_rand($charMap)];
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
