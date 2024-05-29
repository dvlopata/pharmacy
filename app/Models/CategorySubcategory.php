<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategorySubcategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $guarded = false;
}
