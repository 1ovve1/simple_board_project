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
            <th>Изображение</th>
            <th>Заголовок</th>
            <th>Адрес</th>
            <th>Цена</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($boards as $board): ?>
        <tr>
            <td class="w-25">
                <img class="img-fluid" src="<?= assets($board['src']) ?>" alt="image not found">
            </td>
            <td>
                <?= $board['title'] ?>
            </td>
            <td>
                <?= $board['address'] ?>
            </td>
            <td>
                <?= $board['price'] / 1000 ?>
            </td>
            <td>
                <?= ($board['publish'] ?? false) ? '<p class="text-bg-success">Активно</p>': '<p class="text-bg-danger">Закрыто</p>'?>
            </td>
            <td>
                <a href="<?= route('boards.edit', ['id' => $board['id']]) ?>">
                    Изменить
                </a>
                <hr>
                <a class="popup-open text-danger" href="#">
                    Удалить
                </a>

                <div class="popup-fade">
                    <form class="popup form" action="<?= route('boards.delete', ['id' => $board['id']]) ?>" method="post">
                        <?= csrf() ?>

                        <p class="text-center">Вы уверены, что хотите удалить запись?</p>

                        <div class="container text-center">
                            <button type="submit" class="btn btn-danger mx-4">
                                Да
                            </button>
                            <button class="btn btn-primary mx-4 popup-close">
                                Нет
                            </button>
                        </div>
                    </form>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<script src="<?= assets('js/modal_window.js') ?>"></script>

<?php require_once 'layouts/footer.php' ?>