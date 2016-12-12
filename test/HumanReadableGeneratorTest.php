<?php

namespace GfkTest;

use Generator\HumanReadableGenerator;
use PHPUnit\Framework\TestCase;

/**
 * Class HumanReadableGeneratorTest
 */
class HumanReadableGeneratorTest extends TestCase
{
    public static function getWords()
    {
        return [[[
            ['word', 'test', 'newTest'],
            ['dig', 'a', 'ham'],
            ['word'],
            ['home', 'twister', 'phone', 'you', 'tv', 'box', 'eyeball'],
            ['grass', 'bottle', 'dishes', 'bag', 'washing'],
            ['pc', 'door']
        ]]];
    }
    
    /**
     * @expectedException \Exception\EmptyWordsException
     */
    public function testEmptyWords()
    {
        (new HumanReadableGenerator([], 1, 1));
    }

    public function testGenerateMatchesMinimumSize()
    {
        $password = (new HumanReadableGenerator(['dig', 'a', 'ham'], 1, 1))->generate();

        $this->assertTrue(strlen($password) > 5);
    }

    /**
     * @dataProvider getWords
     * @param $wordsArray
     */
    public function testGenerateHasUppercaseCharacter($wordsArray)
    {
        foreach ($wordsArray as $words) {
            $strength =  rand(0, 10);
            $complexity =  rand(0, 10);
            $password = (new HumanReadableGenerator($words, $strength, $complexity))->generate();
            $this->assertTrue((bool)preg_match('/[A-Z]/', $password));
        }
    }

    /**
     * @dataProvider getWords
     * @param array $wordsArray
     */
    public function testGenerateHasLowercaseChar($wordsArray)
    {
        foreach ($wordsArray as $words) {
            $strength =  rand(0, 10);
            $complexity =  rand(0, 10);
            $password = (new HumanReadableGenerator($words, $strength, $complexity))->generate();
            $this->assertTrue((bool)preg_match('/[a-z]/', $password));
        }
    }

    /**
     * @dataProvider getWords
     * @param array $wordsArray
     */
    public function testGenerateHasSpecialChar($wordsArray)
    {
        foreach ($wordsArray as $words) {
            $strength =  rand(0, 10);
            $complexity =  rand(0, 10);
            $password = (new HumanReadableGenerator($words, $strength, $complexity))->generate();
            $this->assertTrue(!ctype_alnum($password));
        }
    }
}
