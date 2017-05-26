<?php

namespace Auth;

use App\Repository\User;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

class AuthAdapter implements AdapterInterface
{
    private $password;
    private $username;
    private $user;

    public function __construct(User $User)
    {
        $this->user = $User;
    }

    public function setPassword(string $password) : void
    {
        $this->password = $password;
    }

    public function setUsername(string $username) : void
    {
        $this->username = $username;
    }

    /**
     * Performs an authentication attempt
     *
     * @return Result
     */
    public function authenticate()
    {

        $usuario = $this->user->findOneByEmail($this->username);

        if (!$usuario) {
            return new Result(Result::FAILURE_IDENTITY_NOT_FOUND, $this->username);
        }

        if (password_verify($this->password, $usuario->getPassword())) {
            return new Result(Result::SUCCESS, $usuario->getArrayCopy());
        }

        return new Result(Result::FAILURE_CREDENTIAL_INVALID, $this->username);
    }
}