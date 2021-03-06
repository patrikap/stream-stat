# stream-stat
Collection of streams statistics

## Задача
Разработать систему сбора статистики для сервиса трансляций, используя Twitch как пример.

 * [~~Каждые N минут~~](./app/Console/Kernel.php "line 28") система должна [~~собирать~~](./app/DataProviders/StreamDataProviderInterface.php "line 25") и 
 [~~сохранять~~](./database/migrations/2020_10_09_112333_create_streams_table.php) список всех активных трансляций для 
 [~~заданных игр (настроенных в БД)~~](./database/migrations/2020_10_09_112333_create_streams_table.php) со следующей информацией:
    * ~~id стримера/канала~~
    * ~~игра~~
    * ~~сервис (twitch, youtube, …)~~
    * ~~количество смотрящих~~

 * Система должна предоставлять [~~RESTful JSON API~~](./composer.json "apiator package") со следующей функциональностью:
    * [~~Авторизация~~](./routes/api.php "auth.sanctum")
    * [~~Фильтрация~~](./app/Http/Filters/QueryFilter.php "фильтрация запросов")
    * [~~Доступ к методам ограничен по IP адресу~~](./app/Http/Middleware/IPAccess.php)

 * ~~Методы API должны выполнять следующие требования:~~
    * [~~Получить список трансляций для:~~](./app/Http/Controllers/API/V1/StreamController.php "index")
        * ~~Игры или списка игр~~
        * ~~Текущего момента или другого временного периода~~
    * [~~Получить количество смотрящих для:~~](./app/Http/Controllers/API/V1/StreamController.php "viewerCount")
        * ~~Игры или списка игр~~
        * ~~Текущего момента или другого временного периода~~
 * [~~Решение нужно сделать на последней версии Laravel~~](./composer.json "version 8.9")
 * ~~Код должен соответствовать стандартам PSR coding and autoloading.~~
 * ~~В качестве внешних зависимостей допускаются только библиотеки composer.~~
 * Контроллер(ы) должны быть покрыты тестами.
 * ~~Результат разработки должен быть залит в Git.~~ 
 * ~~Просьба только не называть его а-ля "Задание для НАСА" :)~~

## Установка

Клонируем репозиторий:
```bash
git clone git@github.com:patrikap/stream-stat.git stream-stat
```

Генерируем ключ приложения:
```bash
php artisan key:generate
```

Наполняем `.env` файл данными.

Выполняем команду: 
```bash
composer deploy
```
 * создаст базу данных (если та не создана)
 * накатит все миграции
 * засеет таблицы 
 * очистит весь кеш приложения

в дальнейшем при деплое достаточно выполнять только её.

## Использование

### Получение списка стримов
`GET /api/v1/stream`

### Получение количества смотрящих
`GET /api/v1/stream/viewer_count`

#### Фильтрация запросов
`game` - идентификатор игры

`games` - идентификаторы игр разделённый запятой

`from` - дата от

`to` - дата до

`now` - 1 // на самом деле любое значение приведённое в `(bool) === true` означает текущий момент
за текущий момент принимает текущее время + 5 минут - 5 минут


### Наполнение базы стримов
`GET /api/v1/stream/collect`

или

`php artisan schedule:work`

или

добавить в кронтаб ежеминутное задание:

`php artisan schedule:run`

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Licence
Please see [LICENSE](LICENSE) for more information.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for more information.

## Authors
* [Konstantin K](https://github.com/patrikap) - developer

## Acknowledgments
* Inspiration
* [Laravel official docs](https://laravel.com/docs/8.x)
* [Принципы построения REST JSON API](https://habr.com/ru/post/447322/)
* [Концепция фильтрации моделей на примере Laravel](https://habr.com/ru/post/485520/)

## Designed by `Patrikap` with &hearts;
