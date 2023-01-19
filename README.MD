# Сайт объявлений недвижимости

## Требования

- php >= 8.1;
- mysql 8;
- желательно запускать, используя laradock (моя изначальная тестовоя среда).

## Конфигурация

Для конфигурации доступа к базе данных требуется задать параметры в файле ./config/db.php:

```php
<?php declare(strict_types=1); 

return [
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'mysql', 
    'DB_NAME' => 'default',
    'DB_PORT' => '3306',
    'DB_USER' => 'default',
    'DB_PASS' => 'secret',

    'LOG_QUERY_RESULTS' => false,
]; 
```

Начальной точкой для старта приложения является файл ./public/index.php.

## Быстрый запуск

После настройки можно запустить скрипты для миграции и заполнения базы тестовыми данными:
```bash 
./cli db reset
./cli db migrate
./cli db seed
```

Тестовый аккаунт: 
- логин: admin
- пароль: secret11

## Изображения
- Главная страница:
![index.png](docs%2Fimg%2Findex.png)
- Работа поиска:
![search.png](docs%2Fimg%2Fsearch.png)
- Объявления пользователей:
![my_boards.png](docs%2Fimg%2Fmy_boards.png)
- Редактирование:
  ![edit_boards.png](docs%2Fimg%2Fedit_boards.png)
- Добавление:
  ![add_boards.png](docs%2Fimg%2Fadd_boards.png)
- Описание объявления:
![detail_boards.png](docs%2Fimg%2Fdetail_boards.png)
- Вход
  ![login.png](docs%2Fimg%2Flogin.png)
- Регистрация
  ![registration.png](docs%2Fimg%2Fregistration.png)
