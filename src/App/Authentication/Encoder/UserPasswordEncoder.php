<?php
/**
 * Created by PhpStorm.
 * User: Viktoria
 * Date: 14.04.2018
 * Time: 12:08
 */

namespace App\Authentication\Encoder;


class UserPasswordEncoder implements UserPasswordEncoderInterface
{
    public function encodePassword(string $rawPassword, ?string $salt = null): string
    {
        return md5($rawPassword . $salt);
    }
}