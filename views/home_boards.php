<?php require_once 'layouts/header.php' ?>

<h2 class="text-center">Добро пожаловать, <?= auth()::user()['first_name'] . ' ' . auth()::user()['last_name'] ?>!</h2>
<p class="text-right">
    <a href="<?= route('boards.create') ?>">Добавить объявление</a>
</p>

<?php if(isset($boards) && !empty($boards)): ?>
    <caption>Объявления:</caption>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Заголовок</th>
            <th>Адрес</th>
            <th>Цена</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($boards as $board): ?>
        <tr>
            <td>
                <?= $board['title'] ?>
            </td>
            <td>
                <?= $board['address'] ?>
            </td>
            <td>
                <?= $board['price'] / 1000 . '.' . $boards['price'] % 1000 ?>
            </td>
            <td>
                <?= ($board['publish'] ?? false) ? '<p class="text-bg-success">Активно</p>': '<p class="text-bg-danger">Закрыто</p>'?>
            </td>
            <td>
                <a href="<?= route('boards.edit', ['id' => $board['id']]) ?>">
                    Изменить
                </a>
                <hr>
                <a href="<?= route('boards.delete', ['id' => $board['id']]) ?>" class="text-danger">
                    Удалить
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require_once 'layouts/footer.php' ?>