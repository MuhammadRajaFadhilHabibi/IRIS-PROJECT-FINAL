<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    protected $fillable = [
        'product_name', 
        'brand', 
        'price', 
        'category', 
        'description'
    ];

    public $table = 'products';
}
