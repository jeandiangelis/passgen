<?php

namespace GfkTest;

use Map\CharMap;
use PHPUnit\Framework\TestCase;

/**
 * Class CharMapTest
 */
class CharMapTest extends TestCase
{
    /**
     * @expectedException \Exception\InvalidCharacterException
     */
    public function testTransformLetterNonValidLetter()
    {
        CharMap::transformLetter('*');
    }

    public function testTransformLetterWithValidLetters()
    {
        $originalLetter = 'f';
        $letter = CharMap::transformLetter($originalLetter);
        $this->assertEquals($originalLetter, $letter);

        $originalLetter = 'a';
        $this->assertNotEquals($originalLetter, CharMap::transformLetter($originalLetter));
    }

    public function testGetRandomChar()
    {
        $this->assertEquals('string', gettype(CharMap::getRandomChar()));
        $this->assertFalse(ctype_alpha(CharMap::getRandomChar()));
    }
}
