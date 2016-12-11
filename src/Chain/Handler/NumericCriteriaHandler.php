<?php

namespace Chain\Handler;

use Chain\AbstractPasswordHandler;
use Map\CharMap;

/**
 * Class NumericCriteriaHandler
 */
final class NumericCriteriaHandler extends AbstractPasswordHandler
{
    /**
     * @param string $password
     * @return bool
     */
    protected function shouldHandle(string $password):bool
    {
        foreach (str_split($password) as $char) {
            if (is_numeric($char)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $password
     * @return string
     */
    public function handle(string $password):string
    {
        if ($this->shouldHandle($password)) {
            $temp = str_split($password);
            $temp = array_keys($temp);
            shuffle($temp);

            foreach ($temp as $key) {
                if (ctype_alpha($password[$key])) {
                    $char = CharMap::transformToDigit($password[$key]);

                    if ($char !== '') {
                        $password[$key] = $char;
                    } else {
                        $password .= CharMap::getRandomDigit();
                    }

                    break;
                } else {
                    continue;
                }
            }
        }

        return parent::handle($password);
    }
}
