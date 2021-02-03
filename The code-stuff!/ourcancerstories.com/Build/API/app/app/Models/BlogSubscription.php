<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSubscription extends Model
{
	protected $fillable = [
        'blog_id', 'user_id'
    ];
}
