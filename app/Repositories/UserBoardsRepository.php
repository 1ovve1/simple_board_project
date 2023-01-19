<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Repositories;

use Lowel\Workproject\App\Models\Boards;
use Lowel\Workproject\App\Models\BoardsImages;
use Lowel\Workproject\App\Models\Users;
use Lowel\Workproject\App\Models\UsersBoards;
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
     * @param int $id_board
     * @return array
     */
    public function show(int $id_user, int $id_board): array
    {
        $query_result = UsersBoards::select([
            'bbs' => ['id', 'title', 'address', 'content', 'price', 'publish'],
            'img' => ['src'],
            'users' => ['first_name', 'last_name', 'phone']
        ], ['bbs_map' => UsersBoards::table()]
        )->innerJoin(
            ['bbs' => Boards::table()], ['bbs' => 'id', 'bbs_map' => 'id_board']
        )->innerJoin(
            ['users' => Users::table()], ['users' => 'id', 'bbs_map' => 'id_user']
        )->leftJoin(
            ['img' => BoardsImages::table()], ['bbs' => 'id', 'img' => 'id_board']
        )->where(
            ['users' => 'id'], $id_user
        )->andWhere(
            ['bbs' => 'id'], $id_board
        )->save();

        return $query_result->fetchAllAssoc()[0];
    }

    /**
     * @param int $id_user
     * @param string $title
     * @param string $address
     * @param string $content
     * @param int $price
     * @param int $publish
     * @param array $imgs_src
     * @return int
     */
    public function create(int $id_user, string $title, string $address, string $content, int $price, int $publish, array $imgs_src = []): int
    {
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
     * @param int $id_user
     * @param int $id_board
     * @param string $title
     * @param string $address
     * @param string $content
     * @param int $price
     * @param int $publish
     * @param array $imgs_src
     * @return void
     */
    public function update(int $id_user, int $id_board,
                         string $title, string $address,
                         string $content, int $price,
                         int $publish, array $imgs_src = []): void
    {
        // check if user have that board
        $check = UsersBoards::select()->where('id_user', $id_user)->andWhere('id_board', $id_board)->save();
        if ($check->isEmpty()) {
            return;
        }

        $params = compact('title', 'address', 'content', 'price', 'publish');

        foreach($params as $field => $value) {
            Boards::update($field, $value)
                ->where('id', $id_board)
                ->save();
        }

        foreach ($imgs_src as $src) {
            BoardsImages::update(
                'src', $src
            )->where(
                'id_board', $id_board
            )->save();
        }

    }

    /**
     * @param int $id_user
     * @param int $id_board
     * @return void
     */
    public function destroy(int $id_user, int $id_board): void
    {
        // check if user have that board
        $check = UsersBoards::select()->where('id_user', $id_user)->andWhere('id_board', $id_board)->save();
        if ($check->isEmpty()) {
            return;
        }

        UsersBoards::delete()
            ->where('id_user', $id_user)
            ->andWhere('id_board', $id_board)
            ->save();

        BoardsImages::delete()
            ->where('id_board', $id_board)
            ->save();

        Boards::delete()
            ->where('id', $id_board)
            ->save();
    }

}