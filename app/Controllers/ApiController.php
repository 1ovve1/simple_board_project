<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Controllers;

use Lowel\Workproject\App\Repositories\PublicBoardsRepository;

class ApiController extends AbstractController
{
    private PublicBoardsRepository $publicBoardsRepository;

    public function __construct()
    {
        $this->publicBoardsRepository = new PublicBoardsRepository();
    }


    function searchBoards(): string
    {
        $search_param = input('search');

        $boards = $this->publicBoardsRepository->search($search_param);

        return self::render('search', compact('boards'));
    }
}