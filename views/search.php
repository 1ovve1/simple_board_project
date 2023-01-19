<?php if (isset($boards) && !empty($boards)): ?>

    <div class="search_result">
        <table class=" w-100">
            <?php foreach ($boards as $board): ?>
                <tr class="row h-100">
                    <td class="col-4 search_result-name">
                        <p><?php echo $board['title']; ?></p>
                    </td>
                    <td class="col-6" style="background-image: url(<?= assets($board['src']) ?>); background-size: cover;">
                    </td>
                    <td class="col-2 search_result-btn">
                        <a class="btn btn-primary" href="<?= route('boards.detail', ['id' => $board['id']]) ?>">Перейти</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

<?php endif ?>
