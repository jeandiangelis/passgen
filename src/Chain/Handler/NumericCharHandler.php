<?php

namespace Chain\Handler;

use Map\CharMap;
use tastebay\Report\Handler\AbstractPasswordHandler;

/**
 * Class NumericCharHandler
 */
final class NumericCharHandler extends AbstractPasswordHandler
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
                    //@todo implement transformToDigit
                } else {
                    continue;
                }
            }
        }

        return parent::handle($password);
    }
}
