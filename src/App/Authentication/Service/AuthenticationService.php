<?php
/**
 * Created by PhpStorm.
 * User: Viktoria
 * Date: 14.04.2018
 * Time: 12:09
 */

namespace App\Authentication\Service;

use App\Authentication\UserTokenInterface;
use App\Authentication\UserInterface;
use App\Authentication\Repository\UserRepositoryInterface;
use App\Authentication\UserToken;

class AuthenticationService implements AuthenticationServiceInterface
{
    private $userRep;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRep = $userRepository;
    }

    /**
     * Метод аутентифицирует пользователя на основании authentication credentials запроса
     *
     * @param mixed $credentials
     * @return UserTokenInterface
     */
    public function authenticate($credentials)
    {
        if ($credentials) {
            list($userLogin, $hash) = preg_split("/( )+/", $credentials);
            if (!$userLogin || !$hash) {
                return UserToken::anonymous();
            }
            $user = $this->userRep->findByLogin($userLogin);
            if (!$user) {
                return UserToken::anonymous();
            }
            if ($hash == $user->getPassword()){
                return new UserToken($user);
            }
        }
        return UserToken::anonymous();
    }

    /**
     * Метод генерирует authentication credentials
     *
     * @param UserInterface $user
     * @return mixed
     */
    public function generateCredentials(UserInterface $user)
    {
        return implode("_", [$user->getId(), $user->getPassword()]);
    }
}