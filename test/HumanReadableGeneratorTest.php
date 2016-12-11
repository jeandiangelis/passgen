<?php

namespace GfkTest;

use Generator\HumanReadableGenerator;
use PHPUnit\Framework\TestCase;

/**
 * Class HumanReadableGeneratorTest
 */
class HumanReadableGeneratorTest extends TestCase
{
    /**
     * @var array
     */
    private $words = [
        ['word', 'test', 'newTest'],
        ['dig', 'a', 'ham'],
        ['word'],
        ['home', 'twister', 'phone', 'you', 'tv', 'box', 'eyeball'],
        ['grass', 'bottle', 'dishes', 'bag', 'washing'],
        ['pc', 'door']
    ];

    /**
     * @expectedException \Exception\EmptyWordsException
     */
    public function testEmptyWords()
    {
        (new HumanReadableGenerator([], 1, 1));
    }

    public function testPasswordMinimumSize()
    {
        $password = (new HumanReadableGenerator(['dig', 'a', 'ham'], 1, 1))->generate();

        $this->assertTrue(strlen($password) > 5);
    }

    public function testAssfsfa()
    {
        $password = (new HumanReadableGenerator(['dig'], 8, 8))->generate();
        $this->assertTrue((bool)preg_match('/[A-Z]/', $password));
    }

    public function testPasswordHasSpecialCharacter()
    {
        foreach ($this->words as $words) {
            $password = (new HumanReadableGenerator($words, rand(0, 10), rand(0, 10)))->generate();
            $this->assertTrue(!ctype_alnum($password));
        }
    }

    public function testPasswordHasUppercaseChar()
    {
        foreach ($this->words as $words) {
            $strength =  rand(0, 10);
            $complexity =  rand(0, 10);
            $password = (new HumanReadableGenerator($words, $strength, $complexity))->generate();
            $this->assertTrue((bool)preg_match('/[A-Z]/', $password));
        }
    }
}
