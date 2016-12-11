<?php

namespace Chain;

use Chain\Handler\LowerCaseCriteriaHandler;
use Chain\Handler\NumericCriteriaHandler;
use Chain\Handler\PasswordLengthCriteriaHandler;
use Chain\Handler\SpecialCharacterCriteriaHandler;
use Chain\Handler\UpperCaseCriteriaHandler;

/**
 * Class PasswordChainBuilder
 */
final class PasswordChainBuilder
{
    /**
     * @var HandlerInterface
     */
    private $chain;

    /**
     * Creates the Chain of Responsibility
     */
    public function __construct()
    {
        $this->chain = (new PasswordLengthCriteriaHandler())
            ->append(new NumericCriteriaHandler())
            ->append(new UpperCaseCriteriaHandler())
            ->append(new LowerCaseCriteriaHandler())
            ->append(new SpecialCharacterCriteriaHandler())
        ;
    }

    /**
     * @param $password
     * @return string
     */
    public function doChain($password)
    {
        return $this->chain->handle($password);
    }
}
