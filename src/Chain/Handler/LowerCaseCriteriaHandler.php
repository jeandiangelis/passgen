<?php

namespace Chain\Handler;

use Chain\AbstractPasswordHandler;
use Map\CharMap;

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

            shuffle($lettersIndex);

            if (count($lettersIndex) > 1) {
                $upperCount =  preg_match_all('/A-Z/', $password);
                foreach ($lettersIndex as $index) {
                    $isUpper = preg_match('/A-Z/', $password[$index]);
                    if ($isUpper && $upperCount > 1) {
                        $swapped = true;
                        $password[$index] = strtolower($password[$index]);
                    }
                }
            }

            if (!$swapped) {
                $password .= CharMap::getRandomLetter();
            }
        }

        return parent::handle($password);
    }
}
