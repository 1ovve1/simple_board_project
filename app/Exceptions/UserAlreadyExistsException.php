<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Exceptions;

use Exception;

class UserAlreadyExistsException extends Exception
{
    public string $username;

    /**
     * Username that was wrong or not found
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;

        parent::__construct();
    }

    function getErrors(): array
    {
        return ['username' => "Пользователь под ником '$this->username' уже существует!"];
    }
}