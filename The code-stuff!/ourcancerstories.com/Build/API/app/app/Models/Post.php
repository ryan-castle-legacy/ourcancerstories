<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
        'post_slug', 'blog_url', 'user_id', 'title', 'summary', 'body', 'featured_image', 'featured_image_caption'
    ];
}
