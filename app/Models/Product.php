<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sku',
        'price',
        'user_id',
        'description'
    ];

    public function getPriceTextAttribute()
    {
        return (env('CURRENCY_SYMBOL')).' '.number_format($this->price, 2);
    }
}
