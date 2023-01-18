<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Repositories;

use Lowel\Workproject\App\Models\Users;

class UsersRepository
{
    /**
     * Return user id by username and password hash
     * @param string $username
     * @return array|false
     */
    static function findUserByUsername(string $username): array|false
    {
        $query_result = Users::select()
            ->where(['username'], $username)
            ->save();

        return $query_result->fetchAllAssoc()[0] ?? false;
    }

    /**
     * @param int $userId
     * @return array
     */
    static function findUserDataById(int $userId): array
    {
        $query_result = Users::select()
            ->where(['id'], $userId)
            ->save();


        return $query_result->fetchAllAssoc()[0];
    }

    /**
     * @param string $username
     * @return bool
     */
    static function isUserExists(string $username): bool
    {
        return Users::findFirst('username', $username)->isNotEmpty();
    }

    /**
     * Insert user and return his id
     * @param string $username
     * @param string $password_hash
     * @param string $first_name
     * @param string $last_name
     * @param int|null $phone
     * @return int
     */
    static function addUser(string $username, string $password_hash,
                            string $first_name, string $last_name,
                            ?int $phone = null): int
    {
        Users::insert(compact('username', 'password_hash', 'first_name', 'last_name', 'phone'))->save();

        $query_result = Users::select(['id'])->where(['username'], $username)->save();
        /** @var int $user_id */
        $user_id = $query_result->fetchAllAssoc()[0]['id'];

        return $user_id;
    }
}