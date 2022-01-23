<?php

namespace App\Filters;

class ContractFilter extends QueryFilter
{
    /** Search by fields in the database
     * @param $search_string
     * @return mixed
     */
    public function search_field($search_string = '')
    {
        return $this->builder
            ->where('name', 'LIKE', '%' . $search_string . '%')
            ->orWhere('surname', 'LIKE', '%' . $search_string . '%')
            ->orWhere('email', 'LIKE', '%' . $search_string . '%')
            ->orWhere('birthday', 'LIKE', '%' . $search_string . '%');
    }
}
