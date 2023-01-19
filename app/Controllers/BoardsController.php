<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Controllers;

use Lowel\Workproject\App\Exceptions\ValidationException;
use Lowel\Workproject\App\Repositories\PublicBoardsRepository;
use Lowel\Workproject\App\Repositories\UserBoardsRepository;
use Lowel\Workproject\App\Validators\BoardValidator;
use Lowel\Workproject\App\Validators\IValidator;

class BoardsController extends AbstractController
{
    private IValidator $validator;
    private UserBoardsRepository $userBoardsRepository;
    private PublicBoardsRepository $publicBoardsRepository;


    public function __construct()
    {
        $this->validator = new BoardValidator();
        $this->userBoardsRepository = new UserBoardsRepository();
        $this->publicBoardsRepository = new PublicBoardsRepository();

        parent::__construct();
    }

    /**
     * @return string
     */
    public function index()
    {
        $user_id = auth()::user()['id'];

        $boards = $this->userBoardsRepository->index($user_id);

        return self::render('home_boards', ['boards' => $boards]);
    }

    /**
     * @param $id
     * @return string
     */
    public function show($id): string
    {
        if (is_auth()) {
            $id_user = auth()::user()['id'];

            $board = $this->userBoardsRepository->show($id_user, (int)$id);
        } else {
            $board = $this->publicBoardsRepository->show((int)$id);
        }

        return self::render('board_detail', compact('board'));
    }

    /**
     * @return string
     */
    public function store()
    {
        return self::render('board_add', ['old' => input('old', []), 'validation_error' => input('validation_error', [])]);
    }

    /**
     * @return void
     */
    public function create()
    {
        $id_user = auth()::user()['id'];

        try {
            $args = $this->validator->validate();

            extract($args);

            $this->userBoardsRepository->create($id_user, $title, $address, $content, (int)($price * 1000), $publish, $img);
        } catch (ValidationException $e) {
            redirect(route(
                'boards.create',
                null,
                ['old' => input()->all(['title', 'price', 'address', 'publish', 'content']), 'validation_error' => $e->getErrors()]
            ));
        }

        redirect(route('home'));
    }

    /**
     * @param $id
     * @return string
     */
    public function edit($id)
    {
        $id_user = auth()::user()['id'];
        $old = input('old', null);

        if (!isset($old)) {
            $board = $this->userBoardsRepository->show($id_user, (int)$id);
        }

        return self::render('board_update', ['old' => $old ?? null, 'board' => $board ?? null, 'validation_error' => input('validation_error', null)]);
    }

    /**
     * @param $id
     * @return void
     */
    public function update($id)
    {
        $id_user = auth()::user()['id'];

        try {
            $args = $this->validator->validate();

            extract($args);

            $this->userBoardsRepository->update($id_user, (int)$id, $title, $address, $content, (int)($price * 1000), $publish, $img);
        } catch (ValidationException $e) {
            redirect(route(
                'boards.edit',
                ['id' => $id],
                ['old' => input()->all(['title', 'price', 'address', 'publish', 'content', 'id']), 'validation_error' => $e->getErrors()]
            ));
        }

        redirect(route('home'));
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        $id_user = auth()::user()['id'];

        $this->userBoardsRepository->destroy($id_user, (int)$id);

        redirect(route('home'));
    }

}