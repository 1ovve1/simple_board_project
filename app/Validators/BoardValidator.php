<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Validators;

use Lowel\Workproject\App\Exceptions\ValidationException;
use Pecee\Http\Input\InputFile;

class BoardValidator implements IValidator
{
    /**
     * @param $args
     * @return array
     * @throws ValidationException
     */
    function validate($args = []): array
    {
        $title = input('title') ?? throw new ValidationException('title', 'Заголовок не найден!');
        $content = input('content') ?? throw new ValidationException('content', 'Контент не найден!');
        $price = input('price') ?? throw new ValidationException('price', 'Цена не найдена!');
        $address = input('address') ?? throw new ValidationException('address', 'Адрес не найден!');
        $publish = (int)input('publish', 0);
        $img = [];

        /** @var InputFile $image */
        foreach (input()->file('img', []) as $image) {
            if ($image->getMime() === 'image/jpeg') {
                $destination_filename = sprintf('%s.%s', uniqid(), $image->getExtension());
                $end_path = $_ENV['ASSETS_PATH'] . "uploads/$destination_filename";

                $image->move($end_path);
                $img[] = "uploads/$destination_filename";
            }
        }

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

        return compact('title', 'price', 'address', 'publish', 'content', 'img');
    }

}