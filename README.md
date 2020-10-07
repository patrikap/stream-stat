# stream-stat
Collection of streams statistics

## Task
Разработать систему сбора статистики для сервиса трансляций, используя Twitch как пример.

 * Каждые N минут система должна собирать и сохранять список всех активных трансляций для заданных игр (настроенных в БД) со следующей информацией:
    * id стримера/канала
    * игра
    * сервис (twitch, youtube, …)
    * количество смотрящих

 * Система должна предоставлять RESTful JSON API со следующей функциональностью:
    * Авторизация
    * Фильтрация
    * Доступ к методам ограничен по IP адресу

 * Методы API должны выполнять следующие требования:
    * Получить список трансляций для:
        * Игры или списка игр
        * Текущего момента или другого временного периода
    * Получить количество смотрящих для:
        * Игры или списка игр
        * Текущего момента или другого временного периода
 * ~~Решение нужно сделать на последней версии Laravel~~
 * ~~Код должен соответствовать стандартам PSR coding and autoloading.~~
 * ~~В качестве внешних зависимостей допускаются только библиотеки composer.~~
 * Контроллер(ы) должны быть покрыты тестами.
 * ~~Результат разработки должен быть залит в Git.~~ 
 * ~~Просьба только не называть его аля "Задание для Mail.Ru" :)~~
