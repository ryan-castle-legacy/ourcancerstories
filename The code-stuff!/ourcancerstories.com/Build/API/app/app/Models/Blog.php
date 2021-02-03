<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	protected $fillable = [
        'blog_url', 'user_id', 'name', 'description'
    ];
}
