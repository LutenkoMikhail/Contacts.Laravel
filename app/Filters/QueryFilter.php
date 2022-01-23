<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilter
{
    public $request;
    protected $builder;
    protected $delimiter = ',';

    /** Сonstruct
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /** Filtered Data
     * @return array|string|null
     */
    public function filters()
    {
        return $this->request->query();
    }

    /** Builder filters
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    /** Parametr to array
     * @param $param
     * @return string[]
     */
    protected function paramToArray($param)
    {
        return explode($this->delimiter, $param);
    }
}
