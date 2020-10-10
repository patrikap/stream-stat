<?php
declare(strict_types = 1);


namespace App\Services;


use Illuminate\Http\Request;

/**
 * Class AccessService
 * @package App\Services
 *
 * Сервис проверки доступа
 *
 * @project stream-stat
 * @date 10.10.2020 23:37
 * @author Konstantin.K
 */
class AccessService
{
    /**
     * Выполнить проверку на соответствие IP -> вызываемому методу
     * просто можно проверить если ли запись в массиве
     *
     * @param Request $request
     * @return bool
     */
    public static function checkAccess(Request $request): bool
    {
        return true;
    }
}
