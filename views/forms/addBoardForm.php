<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Создать объявление</div>

                <div class="card-body">
                    <form method="POST" action="<?= route('boards.create') ?>" enctype="multipart/form-data">
                        <?= csrf() ?>


                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Заголовок:</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control <?= isset($validation_error['title']) ? 'is-invalid': ''?>" name="title" value="<?= $old['title'] ?? '' ?>" required autocomplete="title" autofocus>

                                <?php if (isset($validation_error['title'])): ?>
                                    <span class="invalid-feedback" role="alert">
                                    <strong><?= $validation_error['title'] ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Адрес:</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control <?= isset($validation_error['address']) ? 'is-invalid': ''?>" name="address" value="<?= $old['address'] ?? '' ?>" required autocomplete="address">

                                <?php if (isset($validation_error['address'])): ?>
                                    <span class="invalid-feedback" role="alert">
                                    <strong> <?= $validation_error['address'] ?> </strong>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">Цена:</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control <?= isset($validation_error['price']) ? 'is-invalid': ''?>" name="price" value="<?= $old['price'] ?? '' ?>" required autocomplete="price">

                                <?php if (isset($validation_error['price'])): ?>
                                    <span class="invalid-feedback" role="alert">
                                    <strong> <?= $validation_error['price'] ?> </strong>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="content" class="col-md-4 col-form-label text-md-end">Описание:</label>

                            <div class="col-md-6">
                                <textarea id="content" type="text" class="form-control <?= isset($validation_error['content']) ? 'is-invalid': ''?>" name="content" required autocomplete="fist_name"><?= $old['content'] ?? '' ?></textarea>

                                <?php if (isset($validation_error['content'])): ?>
                                    <span class="invalid-feedback" role="alert">
                                    <strong> <?= $validation_error['content'] ?> </strong>
                                </span>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="img" class="col-md-4 col-form-label text-md-end">
                                Изображение
                            </label>

                            <div class="col-md-6">
                                <input class="form-control" type="file" id="img" name="img[]">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="offset-4 form-check">
                                <label class="form-check-label" for="publish">
                                    Публиковать
                                </label>
                                <input class="form-check-input" type="checkbox" value="1" id="publish" name="publish">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Создать
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
