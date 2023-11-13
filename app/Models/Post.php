<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'price',
        'amount',
        'bathroom',
        'bedroom',
        'area',
        'property_name',
        'date_start_rent',
        'category_id',
        'image_cover',
        'image_id',
        'sale_type_id',
        'property_type_id',
        'user_id',
        'thai_provinces_id',
    ];
}
