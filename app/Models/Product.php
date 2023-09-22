<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'url_image',
        'percent',
        'description',
        'section_id'
    ];



    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details', 'product_id', 'order_id')->withPivot('quantity','totalPrice')->withTimestamps();
    }
}
