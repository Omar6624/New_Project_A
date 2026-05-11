<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    protected $fillable = ['topic_id', 'title', 'slug', 'content', 'widget_html', 'order_index', 'is_published', 'sources'];

    function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
