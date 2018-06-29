<?php
/**
 * Created by PhpStorm.
 * User: Viktoria
 * Date: 14.04.2018
 * Time: 12:14
 */

namespace App\Authentication;


class User implements UserInterface
{

    private $id;
    private $login;
    private $password;
    private $salt;

    public function __construct(string $login, string $password, ?string $salt, int $id = 0)
    {
        $this->login = $login;
        $this->password = $password;
        $this->id = $id;
        $this->salt = $salt;
    }

    /**
     * Метод возвращает идентификационную информацию пользователя (первичный ключ в БД пользователей приложения)
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Метод возвращает логин пользователя. Логин является уникальным свойством.
     *
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * Метод возвращает пароль пользователя. Пароль возвращается в зашифрованном виде.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Метод возвращает соль, которая участвовала при построении пароля
     *
     * @return string|null
     */
    public function getSalt(): ?string
    {
        return $this->salt;
    }
}