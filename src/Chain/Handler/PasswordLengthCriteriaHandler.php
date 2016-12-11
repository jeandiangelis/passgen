<?php

namespace Chain\Handler;

use Chain\AbstractPasswordHandler;
use Map\CharMap;
use Validator\PasswordValidator;

/**
 * Class PasswordLengthCriteriaHandler
 */
final class PasswordLengthCriteriaHandler extends AbstractPasswordHandler
{
    /**
     * @param string $password
     * @return bool
     */
    protected function shouldHandle(string $password):bool
    {
        return strlen($password) < PasswordValidator::REQUIRED_PASSWORD_SIZE;
    }

    /**
     * @param string $password
     * @return string
     */
    public function handle(string $password):string
    {
        $digit = false;
        $upperCaseLetter = false;
        $lowerCaseLetter = false;

        while ($this->shouldHandle($password)) {
            if (!$digit) {
                $password .= CharMap::getRandomDigit();
                $digit = true;
            }

            if (!$upperCaseLetter) {
                $password .= chr(rand(65,90));
                $upperCaseLetter = true;
            }

            if (!$lowerCaseLetter) {
                $password .= chr(rand(97,122));
                $lowerCaseLetter = true;
            }

            $password .= CharMap::getRandomChar();
        }

        return parent::handle($password);
    }
}
