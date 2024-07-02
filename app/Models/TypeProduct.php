<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    use HasFactory;
    protected $table = 'type_products'; 
    protected $primaryKey = 'Type_Id';
    protected $fillable = ['Type_Name'];

}
