<?php

namespace newLife;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
     protected $fillable = ['title', 'body','is_deleted'];
}
