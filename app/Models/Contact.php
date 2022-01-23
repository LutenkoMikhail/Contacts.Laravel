<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'surname', 'email', 'birthday', 'created_at', 'updated_at'
    ];

    /** Relations phone number
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phoneNumber()
    {
        return $this->hasMany(PhoneNumber::class);
    }


    /** Database query filtering
     * @param Builder $builder
     * @param QueryFilter $filter
     * @return Builder
     */
    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
}
