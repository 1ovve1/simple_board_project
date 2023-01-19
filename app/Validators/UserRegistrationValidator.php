<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Validators;

use Lowel\Workproject\App\Exceptions\ValidationException;

class UserRegistrationValidator implements IValidator
{
    function validate($args = []): array
    {
        $username = input('username') ?? throw new ValidationException('username', 'Логин не должен быть пустым');
        $first_name = input('first_name') ?? throw new ValidationException('first_name', 'Логин не должен быть пустым');
        $last_name = input('last_name') ?? throw new ValidationException('last_name', 'Логин не должен быть пустым');
        $phone = input('phone') ?? throw new ValidationException('phone', 'Логин не должен быть пустым');
        $password = input('password');
        $password_confirm = input('password_confirm');

        if (strlen($password) > 255 || strlen($password) < 8) {
            throw new ValidationException('password', 'Слишком длинный пароль! (до 255 символов)');
        }
        if ($password !== $password_confirm) {
            throw new ValidationException('password', 'Подтверждение пароля не соответствует паролю!');
        }
        if (strlen($username) > 50) {
            throw new ValidationException('username', 'Слишком длинный логин! (до 50 символов)');
        }
        if (strlen($first_name) > 50) {
            throw new ValidationException('first_name', 'Слишком длинное имя! (до 50 символов)');
        }
        if (strlen($last_name) > 50) {
            throw new ValidationException('last_name', 'Слишком длинная фамилия! (до 50 символов)');
        }
        if (strlen($phone) > 50) {
            throw new ValidationException('phone', 'Слишком длинный номер телефона! (до 50 символов)');
        }
        if (!preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', $phone)) {
            throw new ValidationException('phone', 'Неверный формат телефона! (поддерживаются ТОЛЬКО номера РФ)');
        }
    }
}