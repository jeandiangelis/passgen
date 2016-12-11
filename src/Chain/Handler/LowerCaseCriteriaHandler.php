<?php

namespace Chain\Handler;

use Map\CharMap;
use tastebay\Report\Handler\AbstractPasswordHandler;

/**
 * Class LowerCaseCriteriaHandler
 */
final class LowerCaseCriteriaHandler extends AbstractPasswordHandler
{
    /**
     * @param string $password
     * @return bool
     */
    protected function shouldHandle(string $password):bool
    {
        return (bool)preg_match('/a-z/', $password);
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
            $swapped = false;

            $lettersIndex = [];
            foreach ($temp as $key) {
                if (ctype_alpha($password[$key])) {
                    $lettersIndex[] = $key;
                } else {
                    continue;
                }
            }

            if (count($lettersIndex) > 1) {
                $swapped = true;
                $randomKey = $lettersIndex[array_rand($lettersIndex)];
                $password[$randomKey] = strtolower($randomKey);
            }

            if (!$swapped) {
                $password .= CharMap::getRandomLetter();
            }
        }

        return parent::handle($password);
    }
}
