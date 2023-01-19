<?php declare(strict_types=1);

namespace Lowel\Workproject\DB\Seed;

use Lowel\Workproject\App\Exceptions\UserAlreadyExistsException;
use Lowel\Workproject\App\Repositories\UserBoardsRepository;
use Lowel\Workproject\App\Repositories\UsersRepository;
use Lowel\Workproject\App\Services\Auth;

class Seeder
{
    static function run(): void
    {
        $boardsRepository = new UserBoardsRepository();
        Auth::start();

        try {
            Auth::$instance->register(
                'admin', 'Админ', 'Админович', '88005553535', 'secret11'
            );
        } catch (UserAlreadyExistsException $e) {
            Auth::$instance->login('admin', 'secret11');
        }

        $id_user = Auth::user()['id'];

        $example_images_path = __DIR__ . '/example_images';

        $files = dir($example_images_path);
        while($files && ($file = $files->read())) {
            @copy("$example_images_path/$file", $_ENV['ASSETS_PATH'] . "uploads/$file");
        }

        $boardsRepository->create(
            $id_user, 'Объект 1', 'ул. Мамадышская 45-78', '9-ый дом, 180 кв. метров, двухуровневая', 7500000,  1, ['uploads/16.jpg']
        );
        $boardsRepository->create(
            $id_user, 'Объект 2', 'ул. Гагарина 56-56', 'ул. Азата Аббасова, д. 11, Казань', 3900000,  1, ['uploads/1930134.jpg']
        );
        $boardsRepository->create(
            $id_user, 'Объект 3', 'ул. Ленинградская 97-01', 'частный дом из сруба, 100 кв.метров', 4500000,  1, ['uploads/1944656.jpg']
        );
        $boardsRepository->create(
            $id_user, 'Объект 4', 'ул. Галимджана Баруди 59-78', 'Кирпичный дом, 80 кв. метров', 3200000,  1, ['uploads/dom-gorodishce-141072644-2.jpg']
        );
        $boardsRepository->create(
            $id_user, 'Объект 5', 'ул. 50 лет Победы 24-32', 'Панельный дом, 45 кв. метров, с двумя лоджиями', 2500000,  1, ['uploads/dom-niva-178145527-2.jpg']
        );
        $boardsRepository->create(
            $id_user, 'Объект 6', 'ул. Аббасова 11-22', 'Продается 2-комн. кв., 64м2, 9/19 этаж', 3900000,  1, ['uploads/foto_largest.jpg']
        );
        $boardsRepository->create(
            $id_user, 'Объект 7', ' ул. Лушникова 50-7', 'Продается 2-комн. кв., 45.8 м2, 1/5 этаж', 2600000,  1, ['uploads/garazh-moskva-1ya-severnaya-liniya-202151582-2.jpg']
        );
        $boardsRepository->create(
            $id_user, 'Объект 8', ' ул. Широка 97-01', 'Продается 2-комн. кв., 63 м2, 9/10 этаж', 4350000,  1, ['uploads/garazh-moskva-bryanskaya-ulica-191385857-2.jpg']
        );
        $boardsRepository->create(
            $id_user, 'Объект 9', 'ул. Хо Ши Мина  56-321', 'Продается 4-комн. кв., 83.5 м2, 10/11 этаж', 3750000,  1, ['uploads/getImage-50.jpeg']
        );
        $boardsRepository->create(
            $id_user, 'Объект 10', ' ул. Фучика 6-97', 'Продается 2-комн. кв., 62.8 м2, 2/16 этаж', 5200000,  1, ['uploads/novostroyka-usady-197995467-2.jpg']
        );
    }

}