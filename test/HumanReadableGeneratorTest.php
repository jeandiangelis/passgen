<?php

namespace GfkTest;

use Generator\HumanReadableGenerator;
use PHPUnit\Framework\TestCase;

/**
 * Class HumanReadableGeneratorTest
 */
class HumanReadableGeneratorTest extends TestCase
{
    public function testGenerateIsString()
    {
        $password = (new HumanReadableGenerator(['word'], 1, 1))->generate();

        $this->assertEquals('string', gettype($password));
    }

    /**
     * @expectedException \Exception\EmptyWordsException
     */
    public function testEmptyWords()
    {
        (new HumanReadableGenerator([], 1, 1));
    }

    public function testPasswordSize()
    {
        $password = (new HumanReadableGenerator(['word', 'test', 'newTest'], 7, 1))->generate();

        $this->assertGreaterThan(7, strlen($password));
    }
}
