<?php
/**
 * Created by PhpStorm.
 * User: Viktoria
 * Date: 14.04.2018
 * Time: 12:18
 */

namespace App\Authentication;


class UserToken implements UserTokenInterface
{
    private $user;

    public function __construct($user = null)
    {
        $this->user = $user;
    }

    public static function anonymous(): UserTokenInterface
    {
        return new self(null);
    }

    /**
     * Метод возвращает соответствующего юзера, если он есть.
     *
     * @return UserInterface|null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * Метод возращает true, если запрос пришел от анонима, иначе false
     *
     * @return bool
     */
    public function isAnonymous()
    {
        return gettype($this->user) === 'NULL';
    }
}