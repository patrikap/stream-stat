<?php
declare(strict_types = 1);


namespace App\Http\Filters;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Class QueryFilter
 * @package App\Http\Filters
 *
 * Базовый класс фильтров
 *
 * @project stream-stat
 * @date 12.10.2020 0:41
 * @author Konstantin.K
 */
abstract class QueryFilter
{
    /**@var Request */
    protected Request $request;

    /** @var Builder */
    protected Builder $builder;

    /**
     * QueryFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * применяет фильтры в текущем объекте к билдеру запроса
     * @param Builder $builder
     */
    public function apply(Builder $builder): void
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            $method = Str::camel($field);
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], (array)$value);
            }
        }
    }

    /**
     * возвращает все поля запроса
     * @return array
     */
    protected function fields(): array
    {
        return array_filter(
            array_map('trim', $this->request->all())
        );
    }
}
