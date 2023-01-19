<?php require_once 'layouts/header.php' ?>

<?php if(isset($board)): ?>
<table class="table">
        <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>Заголовок</th>
            <td>
                <?= $board['title'] ?>
            </td>
        </tr>

        <tr>
            <th>Изображение</th>
            <td>
                <img src="<?= assets($board['src']) ?>" alt="Image not found" class="img-fluid">
            </td>
        </tr>

        <tr>
            <th>Адрес</th>
            <td>
                <?= $board['address'] ?>
            </td>
        </tr>

        <tr>
            <th>Цена</th>
            <td>
                <?= $board['price'] ?>
            </td>
        </tr>

        <tr>
            <th>Автор</th>
            <td>
                <?= $board['first_name'] . ' ' . $board['last_name'] ?>
            </td>
        </tr>

        <tr>
            <th>Контакты</th>
            <td>
                <?= $board['phone'] ?>
            </td>
        </tr>
        </tbody>
    </table>

<?php else: ?>
    <span class="text-danger">
        Объявление не найдено!
    </span>

<?php endif; ?>

<p>
    <a href="<?= (is_auth()) ? route('home'): route('index') ?>">
        На главную
    </a>
</p>

<?php require_once 'layouts/footer.php' ?>
