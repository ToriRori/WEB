<?php
/**
 * Created by PhpStorm.
 * User: Viktoria
 * Date: 14.04.2018
 * Time: 12:08
 */

namespace App\Authentication\Repository;

use App\Authentication\User;
use App\Authentication\UserInterface;

class UserRepository implements UserRepositoryInterface
{
    private $link;

    public function __construct(\mysqli $link)
    {
        $this->link = $link;
    }

    /**
     * Метод ищет пользователя по индентификатору, возвращает UserInterface если пользователь существует, иначе null
     *
     * @param int $id
     * @return UserInterface|null
     */
    public function findById(int $id): ?UserInterface
    {
        $stmt = $this->link->prepare("SELECT * FROM users WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        foreach ($stmt->get_result() as $row) {
            return new User($row['email'], $row['password'], $row['salt'], $row['id']);
            break;
        }
        return null;
    }

    /**
     * Метод ищет пользователя по login, возвращает UserInterface если пользователь существует, иначе null
     *
     * @param string $login
     * @return UserInterface|null
     */
    public function findByLogin(string $login): ?UserInterface
    {
        $stmt = $this->link->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param('s', $login);
        $stmt->execute();

        foreach ($stmt->get_result() as $row) {
            return new User($row['email'], $row['password'], $row['salt'], $row['id']);
            break;
        }
        return null;
    }

    /**
     * Метод сохраняет пользоваля в хранилище
     *
     * @param UserInterface $user
     */
    public function save(UserInterface $user)
    {
        $stmt = $this->link->prepare("INSERT INTO users(email, password, salt) VALUES (?,?,?)");
        $stmt->bind_param('sss', $user->getLogin(),$user->getPassword(), $user->getSalt());
        $stmt->execute();
    }
}