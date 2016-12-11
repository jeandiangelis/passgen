<?php

namespace Chain\Handler;

use Chain\AbstractPasswordHandler;
use Map\CharMap;

/**
 * Class SpecialCharacterCriteriaHandler
 */
final class SpecialCharacterCriteriaHandler extends AbstractPasswordHandler
{
    /**
     * @param string $password
     * @return bool
     */
    protected function shouldHandle(string $password):bool
    {
        return ctype_alnum($password);
    }

    /**
     * @param string $password
     * @return string
     */
    public function handle(string $password):string
    {
        if ($this->shouldHandle($password)) {
            $password .= CharMap::getRandomChar();
        }

        return parent::handle($password);
    }
}
