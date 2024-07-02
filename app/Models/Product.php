<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'Pro_Id';
    protected $fillable = ['Pro_Name', 'Type_product_id', 'Factory_id', 'Pro_OnDate', 'Pro_Price', 'Unit_id', 'Pro_Amount','Pro_image'];
}
