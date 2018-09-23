<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'image', 'user_id'];
    protected $guarded = [];

    /**
     * Get the user that the post belongs to.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
