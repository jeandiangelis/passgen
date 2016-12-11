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

    public function testGetRandomChar()
    {
        $this->assertEquals('string', gettype(CharMap::getRandomChar()));
        $this->assertFalse(ctype_alpha(CharMap::getRandomChar()));
    }
}
