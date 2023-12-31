<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'category_id',
        'product_name',
        'image',
        'price',
        'color',
        'size',
        'desc',
        'status'
    ];
}
