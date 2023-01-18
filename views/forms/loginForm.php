<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Вход</div>

                <div class="card-body">
                    <form method="POST" action="<?= route('login') ?>">
                        <?= csrf() ?>

                        <?php if (isset($username_not_found)): ?>


                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">Логин:</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control is-invalid" name="username" value="<?= $username_not_found ?>" required autocomplete="username" autofocus>

                                    <span class="text-danger">Неверные данные для ввода</span>
                                </div>
                            </div>

                        <?php else: ?>

                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">Логин:</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" value="" required autofocus>
                                </div>
                            </div>

                        <?php endif; ?>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Пароль:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Войти
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
