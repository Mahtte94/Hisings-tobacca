<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' => 'required|max: 100',
        'description' => 'nullable|max:500',
        'price' => 'required|decimal: 0,2|min:0'
    ];

    protected $table = 'product';
}
