<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
</head>
<body>
<form action="http://<?=  url('post-test')->getAbsoluteUrl() ?>" method="post">
    <?= csrf() ?>
    <input type="text" name="data">
    <input type="submit">
</form>

<a href="http://<?= url('logout')->getAbsoluteUrl() ?>">logout</a>
<a href="http://<?= url('login')->getAbsoluteUrl() ?>">login</a>

<pre><?= print_r(auth(), true)?></pre>
</body>
</html>
