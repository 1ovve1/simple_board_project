<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boards</title>
    <link rel="stylesheet" href="<?= assets('css/app.css') ?>">
    <link rel="stylesheet" href="<?= assets('css/bootstrap.min.css') ?>">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand navbar-light bg-light rounded-5 px-4">
        <div class="d-flex">
            <a href="<?= route('index') ?>" class="navbar-brand mr-auto">
                Главная
            </a>
        </div>
        <div class="w-100 d-flex gap-3 justify-content-end align-items-center">

            <?php if(is_auth()): ?>

                <a href="<?= route('home') ?>" class="nav-item nav-link">
                    Мои объявления
                </a>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= auth()::user()['first_name'] . ' ' . auth()::user()['last_name'] ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li class="m-2 rounded-5 bg-light">
                            <form action="<?= route('logout') ?>" method="POST" class="form-inline">
                                <?= csrf() ?>
                                <input type="submit" class="btn btn-danger w-100" value="Выход">
                            </form>
                        </li>
                    </ul>
                </div>

            <?php else:?>

                <a href="<?= route('register_form') ?>" class="nav-item nav-link">
                    Регистрация
                </a>
                <a href="<?= route('login_form') ?>" class="nav-item nav-link">
                    Вход
                </a>

            <?php endif;?>

        </div>
    </nav>
</div>

