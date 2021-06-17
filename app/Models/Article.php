<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'body_text',
        'user_id'
    ];

    public function categories() { return
        $this->belongsToMany(Category::class)
                ->withTimestamps();
    }

    public function tags() { return
        $this->belongsToMany(Tag::class)
                ->withTimestamps();
    }

    public function user() { return
        $this->belongsTo(User::class);
    }
}
