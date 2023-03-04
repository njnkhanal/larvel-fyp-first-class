<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'status', 'category_id', 'company_id', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
