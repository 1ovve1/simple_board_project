<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Регистрация</div>

                <div class="card-body">
                    <form method="POST" action="<?= route('register') ?>">
                        <?= csrf() ?>


                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">Логин:</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control <?= isset($validation_error['username']) ? 'is-invalid': ''?>" name="username" value="<?= $old['username'] ?? '' ?>" required autocomplete="username" autofocus>

                                <?php if (isset($validation_error['username'])): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?= $validation_error['username'] ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">Имя:</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control <?= isset($validation_error['first_name']) ? 'is-invalid': ''?>" name="first_name" value="<?= $old['first_name'] ?? '' ?>" required autocomplete="fist_name">

                                <?php if (isset($validation_error['first_name'])): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong> <?= $validation_error['first_name'] ?> </strong>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">Фамилия:</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control <?= isset($validation_error['last_name']) ? 'is-invalid': ''?>" name="last_name" value="<?= $old['last_name'] ?? '' ?>" required autocomplete="last_name">

                                <?php if (isset($validation_error['last_name'])): ?>
                                    <span class="invalid-feedback" role="alert">
                                    <strong> <?= $validation_error['last_name'] ?> </strong>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Телефон:</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control <?= isset($validation_error['phone']) ? 'is-invalid': ''?>" name="phone" value="<?= $old['phone'] ?? '' ?>" required autocomplete="phone">

                                <?php if (isset($validation_error['phone'])): ?>
                                    <span class="invalid-feedback" role="alert">
                                    <strong> <?= $validation_error['phone'] ?> </strong>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Пароль:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control <?= isset($validation_error['password']) ? 'is-invalid': ''?>" name="password" value="" required>

                                <?php if (isset($validation_error['password'])): ?>
                                    <span class="invalid-feedback" role="alert">
                                    <strong> <?= $validation_error['password'] ?> </strong>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirm" class="col-md-4 col-form-label text-md-end">Подтверждение пароля:</label>

                            <div class="col-md-6">
                                <input id="password_confirm" type="password" class="form-control" name="password_confirm" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Зарегистрироваться
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
