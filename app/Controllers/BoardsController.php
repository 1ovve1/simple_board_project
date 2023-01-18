<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Controllers;

use Lowel\Workproject\App\Exceptions\ValidationException;
use Lowel\Workproject\App\Repositories\UserBoardsRepository;
use Pecee\Controllers\IResourceController;

class BoardsController extends AbstractController
{
    private UserBoardsRepository $boardsRepository;

    public function __construct()
    {
        $this->boardsRepository = new UserBoardsRepository();

        parent::__construct();
    }

    public function index()
    {
        $user_id = auth()::user()['id'];

        $boards = $this->boardsRepository->index($user_id);
        return self::render('home_boards', ['boards' => $boards]);
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function store()
    {
        return self::render('boards_add', ['old' => input('old', []), 'validation_error' => input('validation_error', [])]);
    }

    public function create()
    {
        $title = input('title'); $content = input('content');
        $price = input('price');
        $address = input('address');
        $publish = (int)input('publish', 0);

        $id_user = auth()::user()['id'];

        try {
            $this->boardsRepository->create($id_user, $title, $address, $content, $price, $publish);
        } catch (ValidationException $e) {
            redirect(route(
                'boards.create',
                null,
                ['old' => compact('title', 'price', 'address', 'publish', 'content'), 'validation_error' => $e->getErrors()]
            ));
        }

        redirect(route('home'));
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

}