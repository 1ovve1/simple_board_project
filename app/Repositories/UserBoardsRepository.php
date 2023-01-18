<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Repositories;

use Lowel\Workproject\App\Exceptions\ValidationException;
use Lowel\Workproject\App\Models\Boards;
use Lowel\Workproject\App\Models\BoardsImages;
use Lowel\Workproject\App\Models\Users;
use Lowel\Workproject\App\Models\UsersBoards;
use Pecee\Controllers\IResourceController;
use QueryBox\DBFacade;

class UserBoardsRepository
{
    /**
     * Find all user boards by user id
     * @param int $id_user
     * @return array[]
     */
    public function index(int $id_user): array
    {
        $query_result = UsersBoards::select([
            'bbs' => ['id', 'title', 'address', 'content', 'price', 'publish'],
            'img' => ['src']
        ], ['bbs_map' => UsersBoards::table()]
        )->innerJoin(
            ['bbs' => Boards::table()], ['bbs' => 'id', 'bbs_map' => 'id_board']
        )->innerJoin(
            ['users' => Users::table()], ['users' => 'id', 'bbs_map' => 'id_user']
        )->leftJoin(
            ['img' => BoardsImages::table()], ['bbs' => 'id', 'img' => 'id_board']
        )->where(
            ['users' => 'id'], $id_user
        )->save();

        return $query_result->fetchAllAssoc();
    }

    /**
     * @param int $id_user
     * @param int $board_id
     * @return array
     */
    public function show(int $id_user, int $board_id): array
    {
        $query_result = UsersBoards::select([
            'bbs' => ['id', 'title', 'address', 'content', 'price', 'publish'],
            'img' => ['src']
        ], ['bbs_map' => Boards::table()]
        )->innerJoin(
            ['bbs' => Boards::table()], ['bbs' => 'id', 'bbs_map' => 'id_boards']
        )->innerJoin(
            ['users' => Users::table()], ['users' => 'id', 'bbs_map' => 'id_user']
        )->leftJoin(
            ['img' => BoardsImages::table()], ['bbs' => 'id', 'img.board_id']
        )->where(
            ['usr' => 'id'], $id_user
        )->andWhere(
            ['bbs' => 'id'], $board_id
        )->save();

        return $query_result->fetchAllAssoc();
    }

    /**
     * @param int $id_user
     * @param string $title
     * @param string $address
     * @param string $content
     * @param string $price
     * @param array $imgs_src
     * @return int
     * @throws ValidationException
     */
    public function create(int $id_user, string $title, string $address, string $content, string $price, int $publish, array $imgs_src = []): int
    {
        self::validateBoardsParams($title, $address, $content, $price);

        $price = (int)((double)$price * 1000);

        Boards::insert(
            compact('title', 'address', 'content', 'price', 'publish')
        )->save();

        // Need to add this method into query builder library...
        $id_board = (int)DBFacade::$instance->instance->lastInsertId();

        UsersBoards::insert(
            compact('id_user', 'id_board')
        )->save();

        foreach ($imgs_src as $src) {
            BoardsImages::insert(
                compact('id_board', 'src')
            )->save();
        }

        return $id_board;
    }

    /**
     * @param string $title
     * @param string $address
     * @param string $content
     * @param string $price
     * @return void
     * @throws ValidationException
     */
    private static function validateBoardsParams(string $title, string $address, string $content, string $price)
    {
        if (strlen($title) > 50) {
            throw new ValidationException('title', 'Заголовок слишком большой!');
        }
        if (strlen($address) > 255) {
            throw new ValidationException('title', 'Адрес слишком большой!');
        }
        if (strlen($content) > 3000) {
            throw new ValidationException('content', 'Описание слишком длинное!');
        }
        if (!is_numeric($price) or $price < 500) {
            throw new ValidationException('price', 'Цена слишком маленькая!');
        }
    }

    public function update(int $id_user, int $board_id,
                         string $title, string $address,
                         string $content, int $price,
                         array $imgs_src = []): void
    {
        // check if user have that board
        $check = UsersBoards::select()->where('id_user', $id_user)->andWhere('board_id', $board_id)->save();
        if ($check->isEmpty()) {
            return;
        }

        $params = compact('title', 'address', 'content', 'price');

        foreach($params as $field => $value) {
            Boards::update($field, $value)
                ->where('board_id', $board_id)
                ->save();
        }

        foreach ($imgs_src as $src) {
            BoardsImages::update(
                'src', $src
            )->where(
                'board_id', $board_id
            )->save();
        }

    }

    public function destroy(int $id_user, int $board_id): void
    {
        // check if user have that board
        $check = UsersBoards::select()->where('id_user', $id_user)->andWhere('board_id', $board_id)->save();
        if ($check->isEmpty()) {
            return;
        }

        Boards::delete()
            ->where('board_id', $board_id)
            ->save();
    }

}