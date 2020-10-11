<?php
declare(strict_types = 1);


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

/**
 * Class Filterable
 * @package App\Http\Filters
 *
 * Трейт расширяющий модели для фильтрации
 *
 * @project stream-stat
 * @date 12.10.2020 0:55
 * @author Konstantin.K
 * @method Builder filter() filter(QueryFilter $filter)
 */
trait Filterable
{
    /**
     * @param Builder $builder
     * @param QueryFilter $filter
     */
    public function scopeFilter(Builder $builder, QueryFilter $filter): void
    {
        $filter->apply($builder);
    }
}
