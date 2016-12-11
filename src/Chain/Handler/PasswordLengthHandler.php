<?php

namespace Chain\Handler;

use Map\CharMap;
use tastebay\Report\Handler\AbstractPasswordHandler;
use Validator\PasswordValidator;

/**
 * Class PasswordLengthHandler
 */
final class PasswordLengthHandler extends AbstractPasswordHandler
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