<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Repositories;

use Lowel\Workproject\App\Models\Boards;
use Lowel\Workproject\App\Models\BoardsImages;
use Lowel\Workproject\App\Models\Users;
use Lowel\Workproject\App\Models\UsersBoards;

class PublicBoardsRepository
{
    function getBoards(): array
    {
        $query_result = UsersBoards::select([
            'bbs' => ['id', 'title', 'address', 'content', 'price', 'publish'],
            'img' => ['src']
        ], ['bbs_map' => UsersBoards::table()]
        )->innerJoin(
            ['bbs' => Boards::table()], ['bbs' => 'id', 'bbs_map' => 'id_board']
        )->leftJoin(
            ['img' => BoardsImages::table()], ['bbs' => 'id', 'img' => 'id_board']
        )->where(
            ['bbs' => 'publish'], 1
        )->save();

        return $query_result->fetchAllAssoc();
    }

    /**
     * @param int $id_board
     * @return array
     */
    public function show(int $id_board): array
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
            ['bbs' => 'publish'], 1
        )->andWhere(
            ['bbs' => 'id'], $id_board
        )->save();

        return $query_result->fetchAllAssoc()[0];
    }

    public function search(string $search_param): array
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
            ['bbs' => 'publish'], 1
        )->andWhere(
            ['bbs' => 'title'], 'LIKE', '%' . $search_param . '%'
        )->save();

        return $query_result->fetchAllAssoc();
    }
}