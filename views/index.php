<?php require_once 'layouts/header.php' ?>

<div class="container">
    <div class="search_box">
        <form action="">
            <input type="text" name="search" id="search" placeholder="Введите город">
            <input type="submit">
        </form>
        <div id="search_box-result"></div>
    </div>
</div>

<div class="container">
    <div class="row m-5 g-5">

        <?php foreach (($boards ?? []) as $board): ?>

            <div class="card col-3 mx-3" style="width: 18rem;">
                <img class="card-img-top" src="<?= assets($board['src']) ?>" alt="Нет Изображения">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $board['title'] ?>
                    </h5>
                    <p class="card-text">
                        <?= $board['content'] ?>
                    </p>
                    <a href="<?= route('boards.detail', ['id' => $board['id']]) ?>" class="btn btn-primary">
                        Подробнее
                    </a>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>

<script src="<?= assets('js/search.js') ?>"></script>

<?php require_once 'layouts/footer.php' ?>